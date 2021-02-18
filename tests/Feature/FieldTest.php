<?php

namespace Tests\Feature;

use App\Models\Field\Field;
use App\Traits\FieldTestInputs;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class FieldTest extends TestCase
{
    use RefreshDatabase;
    use FieldTestInputs;

    public function test_admin_can_create_field(): void
    {
        $this->signInAsAdmin();
        $data = $this->getFieldValidInputs();

        $this->post(route('fields.store'), $data);

        self::assertCount(1, Field::all());
    }

    public function test_user_cannot_create_field(): void
    {
        $this->signInAsUser();
        $data = $this->getFieldValidInputs();

        $this->post(route('fields.store'), $data)->assertStatus(302);
        self::assertCount(0, Field::all());
    }

    public function test_admin_can_update_field(): void
    {
        $this->signInAsAdmin();
        $field = factory(Field::class)->create();
        $data = $this->getFieldValidInputs();

        $this->put(route('fields.update', $field->id), $data);

        //check if data updated
        $this->assertDatabaseHas('fields', [
            'name' => $data['name'],
        ]);
    }

    public function test_user_cannot_update_field(): void
    {
        $this->signInAsUser();
        $field = factory(Field::class)->create();
        $data = $this->getFieldValidInputs();

        $this->put(route('fields.update', $field->id), $data)->assertStatus(302);
    }

    public function test_admin_can_delete_field(): void
    {
        $this->signInAsAdmin();
        $field = factory(Field::class)->create();

        $this->delete(route('fields.destroy', $field->id));

        self::assertCount(0, Field::all());
    }

    public function test_user_cannot_delete_field(): void
    {
        $this->signInAsUser();
        $field = factory(Field::class)->create();

        $this->delete(route('fields.destroy', $field->id))->assertStatus(302);
    }

    public function test_valid_name_is_required()
    {
        $this->withoutExceptionHandling();
        $data = $this->getFieldInvalidName();

        $this->post(route('fields.store'), $data)
            ->assertStatus(302);
    }

    public function test_valid_capacity_is_required()
    {
        $this->withoutExceptionHandling();
        $data = $this->getFieldInvalidCapacity();

        $this->post(route('fields.store'), $data)
            ->assertStatus(302);
    }
}
