<?php
namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UsersTableSeeder::class]);
        $this->call([EmailsTableSeeder::class]);
        $this->call([OrganisationsTableSeeder::class]);
        $this->call([AccessLevelsTableSeeder::class]);
        $this->call([StudentsToClassesSeeder::class]);
        $this->call([ClassSeeder::class]);
        $this->call([TaskSeeder::class]);
        $this->call([UnitSeeder::class]);
        $this->call([SubUnitSeeder::class]);
        $this->call([TopicSeeder::class]);
        $this->call([QuestionSeeder::class]);
    }
}
