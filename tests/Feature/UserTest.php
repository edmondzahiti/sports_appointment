<?php

namespace Tests\Feature;

use App\Models\User\User;
use App\Traits\UserTestInputs;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use UserTestInputs;

    public function test_admin_can_create_user(): void
    {
        $this->signInAsAdmin();
        $data = $this->getUserValidInputs();

        $this->post(route('users.store'), $data);

        self::assertCount(2, User::all());
        $this->assertDatabaseHas('users', [
            'email' => $data['email'],
        ]);
    }

    public function test_user_cannot_create_user(): void
    {
        $this->signInAsUser();
        $data = $this->getUserValidInputs();

        $this->post(route('users.store'), $data)->assertStatus(302);
    }

    public function test_admin_can_update_user(): void
    {
        $this->signInAsAdmin();
        $user = $this->getUser();

        $data = $this->getUserUpdatedInputs();

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

        $data = $this->getUserUpdatedInputs();

        $this->put(route('users.update', $user->id), $data)->assertStatus(302);
    }

    public function test_user_can_update_only_his_account(): void
    {
        $user = $this->getUser();
        $this->actingAs($user);

        $data = $this->getUserUpdatedInputs();

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

    public function test_valid_name_is_required()
    {
        $this->withoutExceptionHandling();
        $data = $this->getFieldInvalidName();

        $this->post(route('fields.store'), $data)
            ->assertStatus(302);
    }

    public function test_valid_surname_is_required()
    {
        $this->withoutExceptionHandling();
        $data = $this->getFieldInvalidSurname();

        $this->post(route('fields.store'), $data)
            ->assertStatus(302);
    }

    public function test_valid_email_is_required()
    {
        $this->withoutExceptionHandling();
        $data = $this->getFieldInvalidEmail();

        $this->post(route('fields.store'), $data)
            ->assertStatus(302);
    }

}
