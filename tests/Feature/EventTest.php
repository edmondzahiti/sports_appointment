<?php

namespace Tests\Feature;

use App\Models\Event\Event;
use App\Models\Field\Field;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_event(): void
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();

        $field = Field::create([
            'name'      => 'field name',
            'capacity'  => 30,
        ]);

        $data = [
            'hour'     => Carbon::tomorrow()->format('h'),
            'date'     => Carbon::tomorrow()->format('Y-m-d'),
            'field_id' => $field->id,
            'user'     => auth()->user()->id,
        ];

        $this->post(route('events.store'), $data);

        self::assertCount(1, Event::all());
    }

    public function test_user_can_create_event(): void
    {
        $this->withoutExceptionHandling();
        $this->signInAsUser();

        $field = Field::create([
            'name'      => 'field name',
            'capacity'  => 30,
        ]);

        $data = [
            'hour'     => Carbon::tomorrow()->format('h'),
            'date'     => Carbon::tomorrow()->format('Y-m-d'),
            'field_id' => $field->id,
            'user'     => auth()->user()->id,

        ];

        $this->post(route('events.store'), $data);
        self::assertCount(1, Event::all());
    }

    public function test_admin_can_update_events(): void
    {
        $this->signInAsAdmin();

        $field = Field::create([
            'name'      => 'field name',
            'capacity'  => 30,
        ]);

        $event = Event::create([
            'name'       => 'name',
            'end_time'   => Carbon::today()->format('Y-m-d'),
            'start_time' => Carbon::today()->format('Y-m-d'),
            'field_id'   => $field->id,
            'user_id'    => auth()->user()->id,
        ]);

        $data = [
            'start_time' => Carbon::tomorrow(),
        ];

        $this->put(route('events.update', $event->id), $data);

        //check if data updated
        $this->assertDatabaseHas('events', [
            'start_time' => $data['start_time'],
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
}
