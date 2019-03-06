<?php

use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Author::class, 100)->create()->each(function ($author) {
            $rand = rand(1,5);
            if (($author->office == 'daily' || $author->office == 'styler') && $rand == 1) {
                $topAuthor = new \App\AuthorsTop();
                $topAuthor->office = $author->office;
                $topAuthor->author_id = $author->id;
                $topAuthor->position = rand(1,5);
                $topAuthor->save();
            }
        });
    }
}
