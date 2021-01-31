<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            'id' => 1,
            'task_id' => 1,
            'question' => 'What is 2 + 2?',
            'answer' => '4',
            'options' => '2 | 4 | 6 | 8'
        ]);

        DB::table('questions')->insert([
            'id' => 2,
            'task_id' => 1,
            'question' => 'What is 5 squared?',
            'answer' => '25',
            'options' => '15 | 25 | 50 | 125'
        ]);

        DB::table('questions')->insert([
            'id' => 3,
            'task_id' => 1,
            'question' => 'What is the square root of 36?',
            'answer' => '6',
            'options' => '6 | 12 | 18 | 72'
        ]);
    }
}
