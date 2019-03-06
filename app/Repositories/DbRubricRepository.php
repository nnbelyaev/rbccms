<?php

namespace App\Repositories;

use App\Rubric;

class DbRubricRepository implements RubricRepository
{
    public function getRubricDict() {
        return Rubric::whereHas('translations', function ($query) {
            $query->where('locale', app()->getLocale());
        })->with('translations')->get();
    }
}


