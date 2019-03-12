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
        $this->call(RubricSeeder::class);
        $this->call(PublicationSeeder::class);
        $this->call(PublicationTopSeeder::class);
        $this->call(PublicationFeedsSeeder::class);
        $this->call(PublicationFeedsSpecSeeder::class);
        $this->call(AuthorSeeder::class);
        $this->call(AclSeeder::class);
    }
}
