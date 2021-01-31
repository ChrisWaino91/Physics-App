<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganisationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organisations')->insert([
            'id' => 1,
            'name' => 'Macmillan Academy',
            'expiry_date' => date('Y-m-d', strtotime('+1 year', strtotime(NOW())) ),
            'administrator_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
