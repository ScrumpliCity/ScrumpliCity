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
        User::factory()
            ->has(Room::factory()->count(8))
            ->has(Room::factory()->currentlyPlaying()->count(2))
            ->has(Room::factory()->completed()->count(15))
            ->has(Room::factory()->played()->count(5))
            ->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
    }
}
