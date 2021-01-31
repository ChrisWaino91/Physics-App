<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'title' => 'Mr',
            'forename' => 'Super',
            'surname' => 'Admin',
            'email' => 'super@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'organisation_id' => 1,
            'access_level' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'title' => 'Mr',
            'forename' => 'Example',
            'surname' => 'Admin',
            'email' => 'example@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'organisation_id' => 1,
            'access_level' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'title' => 'Mr',
            'forename' => 'Example',
            'surname' => 'Teacher',
            'email' => 'example@teacher.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'organisation_id' => 1,
            'access_level' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'id' => 4,
            'title' => 'Mr',
            'forename' => 'Example',
            'surname' => 'Student',
            'email' => 'example@student.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'organisation_id' => 1,
            'access_level' => 4,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'id' => 5,
            'title' => 'Mr',
            'forename' => 'Timmy',
            'surname' => 'Otoole',
            'email' => 'timmy@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'organisation_id' => 1,
            'access_level' => 4,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'id' => 6,
            'title' => 'Mr',
            'forename' => 'Bart',
            'surname' => 'Simpson',
            'email' => 'bart@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'organisation_id' => 2,
            'access_level' => 4,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
