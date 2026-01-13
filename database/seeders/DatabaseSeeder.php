<?php

namespace Database\Seeders;

use App\Models\JournalEntry;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );

        // Create journal entries with titles starting with 'T'
        JournalEntry::create([
            'title' => 'T Morning Garden Walk',
            'plant_name' => 'Tomato',
            'notes' => 'Noticed the tomatoes are starting to ripen. Watered the plants this morning.',
        ]);

        JournalEntry::create([
            'title' => 'T Afternoon Planting Session',
            'plant_name' => 'Tulip',
            'notes' => 'Planted new tulip bulbs in the front garden. Used organic fertilizer.',
        ]);

        JournalEntry::create([
            'title' => 'T Evening Harvest',
            'plant_name' => 'Thyme',
            'notes' => 'Harvested fresh thyme for cooking. The plants are growing well.',
        ]);

        JournalEntry::create([
            'title' => 'T Weekly Maintenance',
            'plant_name' => 'Tarragon',
            'notes' => 'Trimmed the tarragon and checked for pests. All looks healthy.',
        ]);

        JournalEntry::create([
            'title' => 'T New Seedlings',
            'plant_name' => 'Turnip',
            'notes' => 'Planted turnip seeds in the vegetable garden. Expecting sprouts in 7-10 days.',
        ]);
    }
}
