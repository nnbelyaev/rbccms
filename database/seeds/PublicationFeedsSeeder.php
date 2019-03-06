<?php

use Illuminate\Database\Seeder;

class PublicationFeedsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($r = 1; $r <= 50; $r++) {
            for ($p = 1; $p <= 5000; $p++) {
                if ($r % 2 == 0 && $p % 2 == 0) continue;
                if ($r % 2 != 0 && $p % 2 != 0) continue;
                $relation = new \App\PublicationFeeds();
                $relation->feed_id = $r;
                $relation->publication_id = $p;
                $relation->save();
            }
        }
    }
}
