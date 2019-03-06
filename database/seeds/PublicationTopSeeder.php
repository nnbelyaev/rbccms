<?php

use Illuminate\Database\Seeder;

class PublicationTopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\PublicationTop::class, 5)->create();
    }
}
