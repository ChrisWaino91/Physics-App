<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('access_levels')->insert([
            'id' => 1,
            'name' => 'Super Admin',
        ]);

        DB::table('access_levels')->insert([
            'id' => 2,
            'name' => 'Admin',
        ]);

        DB::table('access_levels')->insert([
            'id' => 3,
            'name' => 'Teacher',
        ]);

        DB::table('access_levels')->insert([
            'id' => 4,
            'name' => 'Student',
        ]);

        DB::table('access_levels')->insert([
            'id' => 5,
            'name' => 'Parent',
        ]);
    }
}
