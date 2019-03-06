<?php

use Illuminate\Database\Seeder;

class PublicationFeedsSpecSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numbers = range(1, 5000);
        shuffle($numbers);
        $numbers = array_slice($numbers, 0, 400);

        foreach ($numbers as $number) {
            $relation = new \App\PublicationFeeds();
            $relation->feed_id = \App\Publication::FEED_NEWS;
            $relation->publication_id = $number;
            $relation->save();
        }

        $numbers = range(1, 5000);
        shuffle($numbers);
        $numbers = array_slice($numbers, 0, 400);

        foreach ($numbers as $number) {
            $relation = new \App\PublicationFeeds();
            $relation->feed_id = \App\Publication::FEED_LITE;
            $relation->publication_id = $number;
            $relation->save();
        }

        $numbers = range(1, 5000);
        shuffle($numbers);
        $numbers = array_slice($numbers, 0, 400);

        foreach ($numbers as $number) {
            $relation = new \App\PublicationFeeds();
            $relation->feed_id = \App\Publication::FEED_STYLER;
            $relation->publication_id = $number;
            $relation->save();
        }
    }
}

