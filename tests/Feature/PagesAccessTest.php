<?php

namespace Tests\Feature;

use App\Models\Field\Field;
use App\Models\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PagesAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_view_exists(): void
    {
        $response = $this->get('login');

        $response->assertStatus(200);
    }

    public function test_register_view_exists(): void
    {
        $response = $this->get('register');

        $response->assertStatus(200);
    }

    public function test_logged_in_admin_cannot_access_login_page(): void
    {
        $this->signInAsAdmin();
        $response = $this->get('login');

        $response->assertRedirect('/dashboard');
        $response->assertStatus(302);
    }

    public function test_logged_in_user_cannot_access_login_page(): void
    {
        $this->signInAsUser();

        $response = $this->get('login');

        $response->assertRedirect('/dashboard');
        $response->assertStatus(302);
    }

    public function test_all_users_can_access_register_page(): void
    {
        $response = $this->get('register');

        $response->assertStatus(200);
    }

    public function test_all_users_access_login_page(): void
    {
        $response = $this->get('login');

        $response->assertStatus(200);
    }

    public function test_logged_in_admin_cannot_access_register_page(): void
    {
        $this->signInAsAdmin();
        $response = $this->get('register');

        $response->assertRedirect('/dashboard');
        $response->assertStatus(302);
    }

    public function test_logged_in_user_cannot_access_register_page(): void
    {
        $this->signInAsUser();
        $response = $this->get('register');

        $response->assertRedirect('/dashboard');
        $response->assertStatus(302);
    }

    public function test_admin_user_can_access_users_page(): void
    {
        $this->signInAsAdmin();

        $response = $this->get('users');

        $response->assertStatus(200);
    }

    public function test_a_user_cannot_access_users_page(): void
    {
        $this->signInAsUser();
        $response = $this->get('users');

        $response->assertRedirect('');
        $response->assertStatus(302);
    }

    public function test_admin_user_can_access_users_create_page(): void
    {
        $this->signInAsAdmin();
        $response = $this->get('users/create');
        $response->assertStatus(200);
    }

    public function test_a_user_cannot_access_users_create_page(): void
    {
        $this->signInAsUser();
        $response = $this->get('users/create');

        $response->assertRedirect('');
        $response->assertStatus(302);
    }

    public function test_admin_user_can_access_users_edit_page(): void
    {
        $this->signInAsAdmin();

        $user = User::create([
            'name'              => 'newName',
            'surname'           => 'newSurname',
            'username'          => 'newUsername',
            'email'             => 'newEmail',
            'email_verified_at' => today(),
            'password'          => Hash::make('password'),
        ]);

        $response = $this->get(route('users.edit', $user->id));

        $response->assertStatus(200);
    }

    public function test_a_user_cannot_access_users_edit_page(): void
    {
        $this->signInAsUser();

        $user = User::create([
            'name'              => 'newName',
            'surname'           => 'newSurname',
            'username'          => 'newUsername',
            'email'             => 'newEmail',
            'email_verified_at' => today(),
            'password'          => Hash::make('password'),
        ]);

        $response = $this->get(route('users.edit', $user->id));

        $response->assertRedirect('');
        $response->assertStatus(302);
    }

    public function test_admin_user_can_access_fields_page(): void
    {
        $this->signInAsAdmin();
        $response = $this->get('fields');
        $response->assertStatus(200);
    }

    public function test_a_user_cannot_access_fields_page(): void
    {
        $this->signInAsUser();

        $response = $this->get('fields');

        $response->assertRedirect('');
        $response->assertStatus(302);
    }

    public function test_admin_user_can_access_fields_create_page(): void
    {
        $this->signInAsAdmin();
        $response = $this->get('fields/create');
        $response->assertStatus(200);
    }

    public function test_a_user_cannot_access_fields_create_page(): void
    {
        $this->signInAsUser();

        $response = $this->get('fields/create');

        $response->assertRedirect('');
        $response->assertStatus(302);
    }

    public function test_admin_user_can_access_fields_edit_page(): void
    {
        $this->signInAsAdmin();

        $field = Field::create([
            'name'      => 'fieldName',
            'capacity'  => 100
        ]);

        $response = $this->get(route('fields.edit', $field->id));

        $response->assertStatus(200);
    }

    public function test_a_user_cannot_access_fields_edit_page(): void
    {
        $this->signInAsUser();

        $field = Field::create([
            'name'      => 'fieldName',
            'capacity'  => 100
        ]);

        $response = $this->get(route('fields.edit', $field->id));

        $response->assertRedirect('');
        $response->assertStatus(302);
    }

    public function test_all_users_can_access_events_page(): void
    {
        $this->signInAsUser();
        $response = $this->get('events');
        $response->assertStatus(200);
    }

    public function test_all_users_can_access_events_calendar_page(): void
    {
        $this->signInAsAdmin();
        $response = $this->get('events/calendar');
        $response->assertStatus(200);
    }
}
