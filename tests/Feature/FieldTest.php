<?php

namespace Tests\Feature;

use App\Models\Field\Field;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FieldTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_field(): void
    {
        $this->signInAsAdmin();

        $data = [
            'name'      => 'field name',
            'capacity'  => 30,
        ];

        $this->post(route('fields.store'), $data);

        self::assertCount(1, Field::all());
    }

    public function test_user_cannot_create_field(): void
    {
        $this->signInAsUser();

        $data = [
            'name'      => 'field name',
            'capacity'  => 30,
        ];

        $this->post(route('fields.store'), $data)->assertStatus(302);
        self::assertCount(0, Field::all());
    }

    public function test_admin_can_update_field(): void
    {
        $this->signInAsAdmin();
        $field = Field::create([
            'name'      => 'field name',
            'capacity'  => 30,
        ]);

        $data = [
            'name'      => 'updatedField',
            'capacity'  => 10,
        ];

        $this->put(route('fields.update', $field->id), $data);

        //check if data updated
        $this->assertDatabaseHas('fields', [
            'name' => $data['name'],
        ]);
    }

    public function test_user_cannot_update_field(): void
    {
        $this->signInAsUser();
        $field = Field::create([
            'name'      => 'field name',
            'capacity'  => 30,
        ]);

        $data = [
            'name'      => 'updatedField',
            'capacity'  => 10,
        ];

        $this->put(route('fields.update', $field->id), $data)->assertStatus(302);
    }

    public function test_admin_can_delete_field(): void
    {
        $this->signInAsAdmin();

        $field = Field::create([
            'name'      => 'field name',
            'capacity'  => 30,
        ]);

        $this->delete(route('fields.destroy', $field->id));

        self::assertCount(0, Field::all());
    }

    public function test_user_cannot_delete_field(): void
    {
        $this->signInAsUser();
        $field = Field::create([
            'name'      => 'field name',
            'capacity'  => 30,
        ]);

        $this->delete(route('fields.destroy', $field->id))->assertStatus(302);
    }
}
