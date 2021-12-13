<?php

namespace Database\Seeders;

use App\Models\city;
use App\Models\country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        country::truncate();
        city::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        country::factory(20)->create();
        city::factory(200)->create();
    }
}
