<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database with users.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'marina@gmail.com'],
            ['name' => 'Marina', 'password' => bcrypt('123')]
        );

        User::updateOrCreate(
            ['email' => 'maria@gmail.com'],
            ['name' => 'Maria', 'password' => bcrypt('123')]
        );

        User::updateOrCreate(
            ['email' => 'meray@gmail.com'],
            ['name' => 'Meray', 'password' => bcrypt('123')]
        );

        User::updateOrCreate(
            ['email' => 'rania@gmail.com'],
            ['name' => 'Rania', 'password' => bcrypt('123')]
        );
    }
}
