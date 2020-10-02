<?php

namespace App\Http\Requests;

use App\Rules\CurrentPassword;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateUserRequest.
 */
class UpdatePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->canChangePassword();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_password' => ['required', new CurrentPassword],
            'password' => [
                'required',
                'string',
                'min:6',
            ],
            'password_confirmation' => ['required', 'same:password'],
        ];
    }
}
