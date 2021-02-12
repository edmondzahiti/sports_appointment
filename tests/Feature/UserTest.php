<?php

namespace Tests\Feature;

use App\Models\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_user(): void
    {
        $this->signInAsAdmin();

        $data = [
            'name'              => 'test name',
            'surname'           => 'testsurname',
            'username'          => 'test username',
            'email'             => 'test@gmail.com',
            'email_verified_at' => today(),
            'password'          => Hash::make('password'),
            'is_admin'          => false
        ];

        $this->post(route('users.store'), $data);

        self::assertCount(2, User::all());
        $this->assertDatabaseHas('users', [
            'email' => $data['email'],
        ]);
    }

    public function test_user_cannot_create_user(): void
    {
        $this->signInAsUser();

        $data = [
            'name'              => 'test name',
            'surname'           => 'testsurname',
            'username'          => 'test username',
            'email'             => 'test@gmail.com',
            'email_verified_at' => today(),
            'password'          => Hash::make('password'),
            'is_admin'          => false
        ];

        $this->post(route('users.store'), $data)->assertStatus(302);
    }

    public function test_admin_can_update_user(): void
    {
        $this->signInAsAdmin();
        $user = $this->getUser();

        $data = [
            'name'              => 'updated name',
            'surname'           => 'updated surname',
            'email'             => 'updatedEmail@gmail.com',
            'role'              => false
        ];

        $this->put(route('users.update', $user->id), $data);

        //check if data updated
        $this->assertDatabaseHas('users', [
            'email' => $data['email'],
        ]);
    }

    public function test_user_cannot_update_other_users(): void
    {
        $this->signInAsUser();
        $user = $this->getAdmin();

        $data = [
            'name'              => 'updated name',
            'surname'           => 'updated surname',
            'email'             => 'updatedEmail@gmail.com',
            'role'              => false
        ];

        $this->put(route('users.update', $user->id), $data)->assertStatus(302);
    }

    public function test_user_can_update_only_his_account(): void
    {
        $user = $this->getUser();
        $this->actingAs($user);

        $data = [
            'name'              => 'updated name',
            'surname'           => 'updated surname',
            'email'             => 'updatedEmail@gmail.com',
        ];

        $this->put(route('profile.update', $user), $data);

        $this->assertDatabaseHas('users', [
            'email' => $data['email'],
        ]);
    }

    public function test_admin_can_delete_user(): void
    {
        $this->signInAsAdmin();
        $user = $this->getUser();

        $this->delete(route('users.destroy', $user->id));

        $this->assertDatabaseMissing('users', [
            'email' => $user->email,
        ]);
    }

    public function test_user_cannot_delete_other_users(): void
    {
        $this->signInAsUser();
        $user = $this->getAdmin();

        $this->delete(route('users.destroy', $user->id))->assertStatus(302);
    }

}
