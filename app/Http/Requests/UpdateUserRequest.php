<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateUserRequest.
 */
class UpdateUserRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name'      => ['required', 'string', 'max:64'],
            'surname'   => ['required', 'string', 'max:64'],
            'email'     => ['required', 'string', 'email', 'max:191', 'unique:users,email,'. $this->user->id],
        ];
    }

}
