<?php

namespace Tests\Feature;

use App\Models\Event\Event;
use App\Models\Field\Field;
use App\Traits\EventTestInputs;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase;
    use EventTestInputs;

    public function test_admin_can_create_event(): void
    {
        $this->signInAsAdmin();
        $field = factory(Field::class)->create();
        $data = array_merge($this->getEventValidInputs(), ['field_id' => $field->id]);

        $this->post(route('events.store'), $data);

        self::assertCount(1, Event::all());
    }

    public function test_user_can_create_event(): void
    {
        $this->signInAsUser();
        $field = factory(Field::class)->create();
        $data = array_merge($this->getEventValidInputs(), ['field_id' => $field->id]);

        $this->post(route('events.store'), $data);
        self::assertCount(1, Event::all());
    }


    public function test_admin_can_delete_event(): void
    {
        $this->signInAsAdmin();
        $event = factory(Event::class)->create();

        $this->delete(route('events.destroy', $event->id));

        self::assertCount(0, Event::all());
    }

    public function test_user_can_delete_his_event(): void
    {
        $this->signInAsUser();
        $event = factory(Event::class)->create();

        $this->delete(route('events.destroy', $event->id));

        self::assertCount(0, Event::all());
    }

    public function test_user_cannot_delete_other_events(): void
    {
        $this->signInAsUser();
        $otherUser = $this->getAdmin();

        $event = factory(Event::class)->create([
            'user_id' => $otherUser->id,
        ]);

        $this->delete(route('events.destroy', $event->id))->assertStatus(302);
    }


}
