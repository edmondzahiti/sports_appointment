<?php

namespace App\Http\Controllers;


use App\Events\Admin\User\UserPasswordChanged;
use App\Events\Admin\User\UserUpdated;
use App\Exceptions\GeneralException;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\User\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function __construct()
    {

    }

    public function edit()
    {
        $user = auth()->user();
        return view('admin.users.profile', compact('user'));
    }

    public function update(UpdateUserProfileRequest $request)
    {
        $user = auth()->user();
        $data = $request->only(['name', 'surname', 'email', 'language']);

        $this->updateProfile($user, $data);

        return redirect()->route('profile')->with([
            'toastr' => json_encode([
                'type'    => 'success',
                'title'   => 'Success',
                'message' => 'Profile updated successfully!',
            ])
        ]);
    }

    public function updateProfile(User $user, array $data) : User
    {
        $this->checkUserByEmail($user, $data['email']);

        return DB::transaction(function () use ($user, $data) {
            if ($user->update([
                'name' => $data['name'],
                'surname' => $data['surname'],
                'email' => $data['email'],
            ])) {
                return $user;
            }

            throw new GeneralException('error');
        });
    }

    protected function checkUserByEmail(User $user, $email)
    {
        // Figure out if email is not the same and check to see if email exists
        if ($user->email !== $email && $this->model->where('email', '=', $email)->first()) {
            throw new GeneralException('error');
        }
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = auth()->user();

        try {
            $this->checkPassword($user, $request->only('password'));
        } catch (GeneralException $e) {
        }

        return redirect()->route('home')->with([
            'toastr' => json_encode([
                'type'    => 'success',
                'title'   => 'Success',
                'message' => 'Password updated successfully!',
            ])
        ]);
    }

    public function checkPassword(User $user, array $data) : User
    {
        if ($user->update(['password' => Hash::make($data['password'])])) {

            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.update_password_error'));
    }

}
