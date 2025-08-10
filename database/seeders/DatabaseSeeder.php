<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Call your custom seeders here, for example:
        $this->call(SampleDataSeeder::class);
        $this->call(SubjectsTableSeeder::class);
    }
}



