<?php

namespace App\Traits;

use Illuminate\Support\Facades\Hash;

trait UserTestInputs
{
    /**
     * @return array
     */
    public function getUserValidInputs()
    {
        return [
            'name'              => 'test name',
            'surname'           => 'testsurname',
            'username'          => 'test username',
            'email'             => 'test@gmail.com',
            'email_verified_at' => today(),
            'password'          => Hash::make('password'),
            'is_admin'          => false
        ];
    }

    /**
     * @return array
     */
    public function getUserInvalidInputs()
    {
        return [
            'name'              => '',
            'surname'           => '',
            'username'          => '',
            'email'             => '',
            'email_verified_at' => null,
            'password'          => null,
        ];
    }

    /**
     * @return array
     */
    public function getUserUpdatedInputs()
    {
        return [
            'name'              => 'updated name',
            'surname'           => 'updated surname',
            'email'             => 'updatedEmail@gmail.com',
            'role'              => false
        ];
    }

    /**
     * @return array
     */
    public function getFieldInvalidName()
    {
        return [
            'name'              => '',
            'surname'           => 'testsurname',
            'username'          => 'test username',
            'email'             => 'test@gmail.com',
            'email_verified_at' => today(),
            'password'          => Hash::make('password'),
            'is_admin'          => false
        ];
    }

    /**
     * @return array
     */
    public function getFieldInvalidSurname()
    {
        return [
            'name'              => 'name',
            'surname'           => '',
            'username'          => 'test username',
            'email'             => 'test@gmail.com',
            'email_verified_at' => today(),
            'password'          => Hash::make('password'),
            'is_admin'          => false
        ];
    }

    /**
     * @return array
     */
    public function getFieldInvalidEmail()
    {
        return [
            'name'              => 'test name',
            'surname'           => 'testsurname',
            'email'             => '',
            'username'          => 'test username',
            'email_verified_at' => today(),
            'password'          => Hash::make('password'),
            'is_admin'          => false
        ];
    }
}
