<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\Admin\UserRepository;
use DataTables;
use App\Models\User\User;

class UserController extends Controller
{

    protected $userRepository;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable()
    {
        $users = User::get(['id', 'name', 'surname', 'email', 'created_at']);

        return Datatables::of($users)
            ->addColumn('name', function ($user) {
                return $user->name;
            })
            ->addColumn('surname', function ($user) {
                return $user->surname;
            })
            ->addColumn('email', function ($user) {
                return $user->email;
            })
            ->addColumn('created_at', function ($user) {
                return $user->created_at->format('Y-m-d');
            })
            ->addColumn('actions', function ($user) {
                return view('admin.users.includes.actions', compact('user'))->render();
            })
            ->rawColumns(['name', 'surname', 'email', 'created_at', 'actions'])
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $this->userRepository->create($request->all());
        } catch (\Exception $exception) {
            return $this->errorResponse($exception);
        }

        return redirect()->route('users.index')->with([
            'toastr' => json_encode([
                'type'    => 'success',
                'title'   => 'Success',
                'message' => 'User created successfully!',
            ])
        ]);
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $this->userRepository->update($request->all(), $user->id);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception);
        }

        return redirect()->route('users.index')->with([
            'toastr' => json_encode([
                'type'    => 'success',
                'title'   => 'Success',
                'message' => 'User updated successfully!',
            ])
        ]);
    }

    public function destroy($id)
    {
        try {
            $this->userRepository->delete($id);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception);
        }

        return redirect()->route('users.index')->with([
            'toastr' => json_encode([
                'type'    => 'success',
                'title'   => 'Success',
                'message' => 'User deleted successfully!',
            ])
        ]);
    }

}
