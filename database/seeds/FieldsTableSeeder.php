<?php

use App\Models\Field\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class FieldsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('cache:clear');

        Field::create([
            'id' => 1,
            'name' => 'Salla 1',
            'capacity' => '10',
        ]);

        Field::create([
            'id' => 2,
            'name' => 'Salla 2',
            'capacity' => '20',
        ]);

        Field::create([
            'id' => 3,
            'name' => 'Salla 3',
            'capacity' => '30',
        ]);
    }
}
