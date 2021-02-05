<?php

namespace App\Http\Controllers;


use App\Exceptions\GeneralException;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Repositories\Admin\ProfileRepository;

class ProfileController extends Controller
{

    protected $profileRepository;

    /**
     * ProfileController constructor.
     * @param ProfileRepository $profileRepository
     */
    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        $user = auth()->user();
        return view('admin.users.profile', compact('user'));
    }

    /**
     * @param UpdateUserProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserProfileRequest $request)
    {
        try {
            $this->profileRepository->update($request->all(), auth()->user()->id);
        } catch (GeneralException $e) {
            return $this->errorResponse($e);
        }
        return redirect()->route('profile')->with([
            'toastr' => json_encode([
                'type'    => 'success',
                'title'   => 'Success',
                'message' => 'Profile updated successfully!',
            ])
        ]);
    }


    /**
     * @param UpdatePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        try {
            $this->profileRepository->checkPassword(auth()->user, $request->only('password'));
        } catch (GeneralException $e) {
            return $this->errorResponse($e);
        }

        return redirect()->route('home')->with([
            'toastr' => json_encode([
                'type'    => 'success',
                'title'   => 'Success',
                'message' => 'Password updated successfully!',
            ])
        ]);
    }

}
