<?php

use App\Models\User\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('cache:clear');

        User::create([
            'id' => 1,
            'name' => 'Admin',
            'surname' => 'Admin',
            'email' => 'admin@admin.com',
            'username' => 'admin',
            'password' => bcrypt('admin123'),
            'is_admin' => true,
            'can_be_impersonated' => false,
            'email_verified_at' => now(),
            'active' => true,
        ]);

        User::create([
            'id' => 2,
            'name' => 'User',
            'surname' => 'User',
            'email' => 'user@user.com',
            'username' => 'user',
            'password' => bcrypt('user123'),
            'is_admin' => false,
            'can_be_impersonated' => false,
            'email_verified_at' => now(),
            'active' => true,
        ]);
    }
}
