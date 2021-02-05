<?php

namespace App\Traits;

use App\Models\Event\Event;

trait EventTrait
{
    public $sources = [
        [
            'model' => '\\App\\Models\\Event\\Event',
            'date_field' => 'start_time',
            'field' => 'name',
            'prefix' => 'Game',
            'suffix' => '',
        ],
    ];


    /**
     * @return array
     */
    public function events()
    {
        $events = [];

        foreach ($this->sources as $source) {
            $calendarEvents = Event::where('field_id', request('field_id') ? request('field_id') : 1)->get();

            foreach ($calendarEvents as $model) {

                $crudFieldValue = $model->getAttributes($source['date_field']);
                $user_ids = $model->getAttributes($model->user_id);

                if (!$crudFieldValue) {
                    continue;
                }

                if (auth()->user()->isAdmin() || in_array(auth()->user()->id, $user_ids)) {
                    $events[] = [
                        'title' => trim($source['prefix'] . " " . $model->{$source['field']}
                            . " " . $source['suffix']),
                        'start' => $crudFieldValue['start_time'],
                        'url' => route('events.edit', $model->id),
                        'color' => '#76A917',
                    ];
                } else {
                    $events[] = [
                        'title' => trim($source['prefix'] . " " . $model->{$source['field']}
                            . " " . $source['suffix']),
                        'start' => $crudFieldValue['start_time'],
                        'url' => '#',
                        'color' => '#ff4000',
                    ];
                }
            }
        }

        return $events;
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function freeEvents($data)
    {
        $year = date('Y', strtotime($data['date']));
        $month = date('m', strtotime($data['date']));
        $day = date('d', strtotime($data['date']));


        if (now() > $data['date'] && empty($data['isEditingEvent'])) {
            return response()->json('failed');
        } else {

            $workingHours = [];
            for ($x = 1; $x < 24; $x++) {
                if ($x < 10) {
                    $x = 0 . $x;
                }
                $workingHours [] = $x;
            }

            if (!empty($data['isEditingEvent'])) {
                $activeEvents = Event::whereYear('start_time', $year)
                    ->where('id', '!=', $data['event_id'])
                    ->whereMonth('start_time', $month)
                    ->whereDay('start_time', $day)
                    ->where('field_id', $data['field_id'])
                    ->get();
            } else {
                $activeEvents = Event::whereYear('start_time', $year)
                    ->whereMonth('start_time', $month)
                    ->whereDay('start_time', $day)
                    ->where('field_id', $data['field_id'])->get();
            }


            $busyEvents = [];
            foreach ($activeEvents as $activeEvent) {
                $busyEvents [] = ($activeEvent->start_time)->format('H');
            }

            $freeEvents = [];
            foreach ($workingHours as $workingHour) {
                if (in_array($workingHour, $busyEvents)) {
                    unset($workingHour);
                } else {
                    $freeEvents [] = [
                        'start_time' => $workingHour,
                        'end_time' => $workingHour + 1,
                    ];
                }
            }
            return response()->json($freeEvents);
        }
    }

    /**
     * @param $month
     * @param $year
     * @return \Illuminate\Http\JsonResponse
     */
    public function datesMonth($month, $year)
    {
        $num = date('t', mktime(0, 0, 0, $month, 1, $year));

        $dates_month = array();

        for ($i = 1; $i <= $num; $i++) {
            $mktime = mktime(0, 0, 0, $month, $i, $year);
            $date = date("d-m-Y", $mktime);
            $dates_month[$i] = $date;
        }

        return response()->json($dates_month);
    }

}
