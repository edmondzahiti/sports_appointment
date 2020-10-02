<?php

namespace App\Http\Controllers;

use App\Events\Auth\UserRegistered;
use App\Http\Requests\StoreUserRequest;
use DataTables;
use Illuminate\Http\Request;
use App\Models\User\User;
use App\Models\User\SocialIdentity;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function __construct()
    {

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

    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'role' => $request->is_admin,
        ]);

        $user->update([
            'password' => Hash::make($user->name.$user->created_at->format('h:s').$user->surname.$user->created_at->format('i')),
            'email_verified_at' => now(),
        ]);

        event(new UserRegistered($user));

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

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'alpha', 'max:64'],
            'surname' => ['required', 'string', 'alpha', 'max:64'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users,email,'. $user->id],
        ]);

        if ($user->email != $request->email)
        {
            $user->update([
                'password' => Hash::make($user->name.$user->created_at->format('h:s').$user->surname.$user->created_at->format('i')),
                'email' => $request->email,
            ]);
            event(new UserRegistered($user));
        }

        $user->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'is_admin' => $request->role,
        ]);

        return redirect()->route('users.index')->with([
            'toastr' => json_encode([
                'type'    => 'success',
                'title'   => 'Success',
                'message' => 'User updated successfully!',
            ])
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with([
            'toastr' => json_encode([
                'type'    => 'success',
                'title'   => 'Success',
                'message' => 'User deleted successfully!',
            ])
        ]);
    }

}
