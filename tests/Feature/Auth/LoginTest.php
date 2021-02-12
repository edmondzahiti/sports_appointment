<?php

namespace Tests\Feature\Auth;

use App\Models\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use  RefreshDatabase;

    public function test_user_can_view_a_login_form(): void
    {
        $response = $this->get('login');

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function test_user_can_view_dashboard_when_authenticated(): void
    {
        $response = $this->actingAs($this->getUser())->get('login');

        $response->assertRedirect('/dashboard');
    }

    public function test_user_can_login_with_correct_credentials(): void
    {
        $user = $this->getUser();

        $response = $this->from('login')->post('login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_login_with_incorrect_email(): void
    {
        $user = $this->getUser();

        $response = $this->from('login')->post('login', [
            'email' => 'test@not.test',
            'password' => '12345678'
        ]);

        $response->assertRedirect('login');
        $this->assertInvalidCredentials(['email' => $user->email, 'password' => $user->password]);
        $response->assertSessionHasErrors('email');
        self::assertTrue(session()->hasOldInput('email'));
        self::assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function test_user_cannot_login_with_empty_email(): void
    {
        $user = $this->getUser();

        $response = $this->from('login')->post('login', [
            'email' => null,
            'password' => '12345678'
        ]);

        $response->assertRedirect('login');
        $this->assertInvalidCredentials(['email' => $user->email, 'password' => $user->password]);
        $response->assertSessionHasErrors('email');
        self::assertFalse(session()->hasOldInput('email'));
        self::assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function test_user_cannot_login_with_incorrect_password(): void
    {
        $user = $this->getUser();

        $response = $this->from('login')->post('login', [
            'email' => $user->email,
            'password' => null
        ]);

        $response->assertRedirect('login');
        $response->assertSessionHasErrors('password');
        self::assertTrue(session()->hasOldInput('email'));
        self::assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }
}
