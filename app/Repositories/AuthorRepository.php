<?php

namespace App\Repositories;

interface AuthorRepository {
    public function getAuthorDict();
    public function getDailyTop();
    public function getStylerTop();
}

