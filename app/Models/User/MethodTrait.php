<?php

namespace App\Models\User;

trait MethodTrait {

	/**
	 * check if the user is the current loggedIn one.
	 * @return bool
	 */
	public function isCurrentUser(): bool
	{
	    if (!$this->id) {
	        return false;
	    }
	    return $this->id === auth()->id();
	}

	public function isAdmin(): bool
	{
	    return $this->is_admin == 1;
	}

	public function isUser(): bool
	{
        return $this->is_admin != 1;
	}

    public function canChangePassword()
    {
        return !app('session')->has(config('app.socialite_session_name'));
    }
}
