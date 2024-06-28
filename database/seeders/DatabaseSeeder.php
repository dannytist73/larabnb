<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Listing;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Danny Ngipol',
            'email' => 'dannytist@gmail.com',
            'is_admin' => true
        ]);

        User::factory()->create([
            'name' => 'April Wayne',
            'email' => 'april@gmail.com'
        ]);

        Listing::factory(10)->create([
            'by_user_id' => 1
        ]);

        Listing::factory(10)->create([
            'by_user_id' => 2
        ]);
    }
}
