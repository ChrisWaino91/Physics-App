<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('emails')->insert([
            'id' => 1,
            'name' => 'Task Assigned',
        ]);

        DB::table('emails')->insert([
            'id' => 2,
            'name' => 'Task Completed',
        ]);

        DB::table('emails')->insert([
            'id' => 3,
            'name' => 'Task Results',
        ]);
    }
}
