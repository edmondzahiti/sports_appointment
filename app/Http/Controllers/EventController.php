<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Models\Field;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateTime;
use Illuminate\Http\Request;
use DataTables;

class EventController extends Controller
{

    public function index()
    {
        return view('admin.events.index');
    }

    public function datatable()
    {

        if (auth()->user()->isAdmin())
        {
            $events = Event::get(['id', 'name', 'start_time', 'field_id', 'user_id']);
        }else{
            $events = Event::where('user_id', auth()->user()->id)->get(['id', 'name', 'start_time', 'field_id', 'user_id']);
        }

        return Datatables::of($events)
            ->addColumn('id', function ($events) {
                return $events->id;
            })
            ->addColumn('name', function ($events) {
                return $events->name;
            })
            ->addColumn('start_time', function ($events) {
                return $events->start_time;
            })
            ->addColumn('actions', function ($event) {
                return view('admin.events.includes.actions', compact('event'))->render();
            })
            ->rawColumns(['id', 'name', 'start_time', 'actions'])
            ->make(true);
    }


    public $sources = [
        [
            'model'      => '\\App\\Models\\Event',
            'date_field' => 'start_time',
            'field'      => 'name',
            'prefix'     => 'Game',
            'suffix'     => '',
//            'route'      => 'events.edit',
        ],
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function calendar()
    {
        $events = [];

        $fields = Field::all();

        foreach ($this->sources as $source) {
            $calendarEvents = $source['model']::when(request('field_id') && $source['model'] == '\App\Models\Event', function($query) {
                return $query->where('field_id', request('field_id'));
            })->get();
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



        return view('admin.events.calendar', compact('events', 'fields'));
    }

    public function getFreeEvents(Request $request)
    {
        $year = date('Y', strtotime($request->date));
        $month = date('m', strtotime($request->date));
        $day = date('d', strtotime($request->date));


        if (now()->month > $month) {
            return response()->json('failed');
        }else{

            $workingHours = [];
            for ($x = 1; $x < 24; $x++) {
                if ($x < 10) {
                    $x = 0 . $x;
                }
                $workingHours [] = $x;
            }

            if (!empty($request->isEditingEvent))
            {
                $activeEvents = Event::whereYear('start_time', $year)
                    ->where('id', '!=', $request->event_id)
                    ->whereMonth('start_time', $month)
                    ->whereDay('start_time', $day)
                    ->where('field_id', $request->field_id)
                    ->get();
            }else{
                $activeEvents = Event::whereYear('start_time', $year)
                    ->whereMonth('start_time', $month)
                    ->whereDay('start_time', $day)
                    ->where('field_id', $request->field_id)->get();
            }


            $busyEvents = [];
            foreach ($activeEvents as $activeEvent)
            {
                $busyEvents [] = ($activeEvent->start_time)->format('H');
            }

            $freeEvents = [];
            foreach ($workingHours as $workingHour)
            {
                if (in_array($workingHour, $busyEvents))
                {
                    unset($workingHour);
                }
                else{
                    $freeEvents [] = [
                        'start_time' => $workingHour,
                        'end_time' => $workingHour+1,
                    ];
                }
            }
            return response()->json($freeEvents);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = $request->date;
        $hour = $request->hour.':00:00';

        $start_time = $date. ' ' . $hour;

        Event::create([
            'name' => auth()->user()->name,
            'start_time' => $start_time,
            'field_id'   => $request->field_id,
            'user_id'   => auth()->user()->id,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $months = $this->monthListFromDate(Carbon::now());
        $fields = Field::get(['id', 'name']);

//        dd($event->start_time->format('y'));

        return view('admin.events.edit', compact('fields','event', 'months'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $event)
    {

        $date = $request->day;
        $dateformat = DateTime::createFromFormat('m-d-Y', $date)->format('Y-d-m');
        $hour = $request->date.':00:00';
        $start_time = $dateformat. ' ' . $hour;

        Event::where('id', $event->id)->update([
            'start_time' => $start_time,
        ]);

        return redirect()->route('events.calendar')->with([
            'toastr' => json_encode([
                'type'    => 'success',
                'title'   => 'Success',
                'message' => 'Event updated successfully!',
            ])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with([
            'toastr' => json_encode([
                'type'    => 'success',
                'title'   => 'Success',
                'message' => 'Event deleted successfully!',
            ])
        ]);
    }

    public function monthListFromDate(Carbon $start)
    {
        foreach (CarbonPeriod::create($start, '1 month', now()->year-2017) as $month) {
            $months[$month->format('m-Y')] = $month->format('F Y');
        }
        return $months;
    }

    public function dates_month($month, $year) {
        $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $dates_month = array();

        for ($i = 1; $i <= $num; $i++) {
            $mktime = mktime(0, 0, 0, $month, $i, $year);
            $date = date("d-m-Y", $mktime);
            $dates_month[$i] = $date;
        }

        return response()->json($dates_month);
    }


}
