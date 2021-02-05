<?php

namespace App\Repositories\Admin;

use App\Exceptions\GeneralException;
use App\Models\Event\Event;
use App\Models\User\User;
use App\Repositories\BaseRepository;
use App\Traits\EventTrait;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

/**
 * Class EventRepository.
 */
class EventRepository extends BaseRepository
{

    use EventTrait;

    /**
     * EventRepository constructor.
     *
     * @param Activity $model
     */
    public function __construct(Event $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {

            $event = $this->createEvent($data);

            if ($event) {
                return $event;
            }

            throw new GeneralException(__('There was a problem creating event.'));
        });
    }

    /**
     * @param array $data
     * @return Event
     */
    protected function createEvent(array $data = []): Event
    {
        $date = $data['date'];
        $hour = $data['hour'] . ':00:00';
        $start_time = $date . ' ' . $hour;

        $user = $this->getEventUser($data);

        return $this->model::create([
            'name' => $user->name,
            'start_time' => $start_time,
            'field_id' => $data['field_id'],
            'user_id' => $user->id,
        ]);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function getEventUser($data)
    {
        if (auth()->user()->isAdmin()) {
            $userId = $data['user'];
        } else {
            $userId = auth()->user()->id;
        }

        $user = User::where('id', $userId)->first();

        return $user;
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data, int $id)
    {
        return DB::transaction(function () use ($data, $id) {

            $event = $this->updateEvent($data, $id);

            if ($event) {
                return $event;
            }

            throw new GeneralException(__('There was a problem updating event.'));
        });
    }

    /**
     * @param array $data
     * @param int $id
     * @return Event
     */
    public function updateEvent(array $data, int $id): Event
    {
        $startTime = $this->getFormattedDate($data);

        $event = $this->find($id);

        $event->update([
            'start_time' => $startTime,
        ]);

        return $event->refresh();
    }

    /**
     * @param int $id
     * @return Event
     */
    public function find(int $id): Event
    {
        return $this->model->find($id);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->model->where('id', $id)->delete();
    }

    /**
     * @param Carbon $start
     * @return mixed
     */
    public function monthListFromDate(Carbon $start)
    {
        foreach (CarbonPeriod::create($start, '1 month', now()->year - 2017) as $month) {
            $months[$month->format('m-Y')] = $month->format('F Y');
        }
        return $months;
    }

    /**
     * @return mixed
     */
    public function manageUserEventRole()
    {
        if (auth()->user()->isAdmin()) {
            return Event::get(['id', 'name', 'start_time', 'field_id', 'user_id']);
        } else {
            return Event::where('user_id', auth()->user()->id)->get(['id', 'name', 'start_time', 'field_id', 'user_id']);
        }
    }

    /**
     * @param $data
     * @return string
     */
    public function getFormattedDate($data)
    {
        $date = $data['day'];
        $dateFormat = DateTime::createFromFormat('m-d-Y', $date)->format('Y-d-m');
        $hour = $data['date'] . ':00:00';
        $start_time = $dateFormat . ' ' . $hour;

        return $start_time;
    }

    /**
     * @return array
     */
    public function getEvents()
    {
        return $this->events();
    }

    /**
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFreeEvents(array $data)
    {
        return $this->freeEvents($data);
    }

    /**
     * @param $month
     * @param $year
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDatesMonth($month, $year)
    {
        return $this->datesMonth($month, $year);
    }

}

