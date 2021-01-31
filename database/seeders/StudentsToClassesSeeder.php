<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsToClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students_to_classes')->insert([
            'id' => 1,
            'user_id' => 4,
            'class_id' => 1
        ]);
    }
}
