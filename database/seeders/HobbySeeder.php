<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HobbySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('hobbies')->insert([
            ['name' => 'Reading', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sports', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Music', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cooking', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Traveling', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}