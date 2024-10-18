<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Room;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->has(Room::factory()->count(5))->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
