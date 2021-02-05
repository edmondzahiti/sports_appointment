<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateEventRequest;
use App\Models\Event\Event;
use App\Models\Field\Field;
use App\Models\User\User;
use App\Repositories\Admin\EventRepository;
use App\Repositories\Admin\FieldRepository;
use App\Repositories\Admin\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;

class EventController extends Controller
{

    protected $eventRepository;

    /**
     * EventController constructor.
     * @param EventRepository $eventRepository
     */
    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.events.index');
    }

    /**
     * @return mixed
     */
    public function datatable()
    {
        $events = $this->eventRepository->manageUserEventRole();

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

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        try {
            $this->eventRepository->create($request->all());
        } catch (\Exception $exception) {
            return $this->errorResponse($exception);
        }
    }

    /**
     * @param Event $event
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Event $event)
    {
        $months = $this->eventRepository->monthListFromDate(Carbon::now());
        $fields = app()->make(FieldRepository::class)->get();
        $date = now();

        return view('admin.events.edit', compact('fields','event', 'months', 'date'));
    }

    /**
     * @param UpdateEventRequest $request
     * @param Event $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateEventRequest $request, $id)
    {
        try {
            $this->eventRepository->update($request->all(), (int)$id);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception);
        }

        return redirect()->route('events.calendar')->with([
            'toastr' => json_encode([
                'type'    => 'success',
                'title'   => 'Success',
                'message' => 'Event updated successfully!',
            ])
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->eventRepository->delete($id);

        return redirect()->route('events.index')->with([
            'toastr' => json_encode([
                'type'    => 'success',
                'title'   => 'Success',
                'message' => 'Event deleted successfully!',
            ])
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function calendar()
    {
        $users = app()->make(UserRepository::class)->get();
        $fields = app()->make(FieldRepository::class)->get();
        $events = $this->eventRepository->getEvents();

        return view('admin.events.calendar', compact('events', 'fields', 'users'));
    }

    /**
     * @param $month
     * @param $year
     * @return \Illuminate\Http\JsonResponse
     */
    public function dates_month($month, $year) {
        return $this->eventRepository->getDatesMonth($month, $year);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFreeEvents(Request $request)
    {
        return $this->eventRepository->getFreeEvents($request->all());
    }

}
