<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('class_groups')->insert([
            'id' => 1,
            'organisation_id' => 2,
            'user_id' => 3,
            'name' => '7NMi Physics',
            'year_group' => 7,
            'active' => 1,
            'deleted' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('class_groups')->insert([
            'id' => 2,
            'organisation_id' => 2,
            'user_id' => 3,
            'name' => '9RLa Physics',
            'year_group' => 9,
            'active' => 1,
            'deleted' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
