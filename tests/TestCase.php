<?php

namespace Tests;

use App\Models\User\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Hash;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function signInAsAdmin()
    {
        return $this->actingAs($this->getAdmin());
    }

    protected function signInAsUser()
    {
        return $this->actingAs($this->getUser());
    }

    protected function getAdmin()
    {
        return User::create([
            'name'              => 'admin name',
            'surname'           => 'admin surname',
            'username'          => 'admin username',
            'email'             => 'admin@gmail.com',
            'email_verified_at' => today(),
            'password'          => Hash::make('password'),
            'is_admin'          => true
        ]);
    }

    protected function getUser()
    {
        return User::create([
            'name'              => 'user name',
            'surname'           => 'user surname',
            'username'          => 'username',
            'email'             => 'userEmail@gmail.com',
            'email_verified_at' => today(),
            'password'          => Hash::make('password'),
        ]);
    }
}
