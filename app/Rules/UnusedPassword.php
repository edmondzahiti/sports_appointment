<?php

namespace App\Rules;

use App\Models\User\User;
use App\Repositories\Admin\UserRepository;

use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class UnusedPassword.
 */
class UnusedPassword implements Rule
{
    /**
     * @var
     */
    protected $user;

    /**
     * Create a new rule instance.
     *
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        dd('123');
        // Option is off
        if (!config('app.password_history')) {
            return true;
        }

        if (! $this->user instanceof User) {
            if (is_numeric($this->user)) {
                $this->user = resolve(UserRepository::class)->getById($this->user);
            } else {
                $this->user = resolve(UserRepository::class)->getByColumn($this->user, 'email');
            }
        }

        if (! $this->user || null === $this->user) {
            return false;
        }

        $histories = $this->user
            ->passwordHistories()
            ->take(config('app.password_history'))
            ->orderBy('id', 'desc')
            ->get();

        foreach ($histories as $history) {
            if (Hash::check($value, $history->password)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('auth.password_used');
    }

}
