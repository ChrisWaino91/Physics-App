<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('topics')->insert([
            'id' => 1,
            'sub_unit_id' => 1,
            'name' => 'Energy Stores',
        ]);

        DB::table('topics')->insert([
            'id' => 2,
            'sub_unit_id' => 1,
            'name' => 'Changes In Energy Calculation',
        ]);

        DB::table('topics')->insert([
            'id' => 3,
            'sub_unit_id' => 1,
            'name' => 'Energy Transfers',
        ]);

        DB::table('topics')->insert([
            'id' => 4,
            'sub_unit_id' => 1,
            'name' => 'Mechanical Work Done',
        ]);

        DB::table('topics')->insert([
            'id' => 5,
            'sub_unit_id' => 1,
            'name' => 'Electrical Work Done',
        ]);
    }
}
