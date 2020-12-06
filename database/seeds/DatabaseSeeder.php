<?php

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
        $this->call([
            AdminSeeder::class,
            AlternatifSeeder::class,
            KriteriaSeeder::class,
            DaerahSeeder::class,
            PerKriteriaSeeder::class,
            PerAlternatifSeeder::class,
            ]);
    }
}
