<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class DbAuthorRepository implements AuthorRepository
{
    public function getAuthorDict() {
        return Rubric::whereHas('translations', function ($query) {
            $query->where('locale', app()->getLocale());
        })->with('translations')->get();
    }

    public function getDailyTop()
    {
        $locale  = app()->getLocale();
        $rows = DB::table('authors_top as POS')
            ->join('authors as AUS', 'POS.author_id', '=', 'AUS.id')
            ->join('author_names as NAM', function ($join) use ($locale) {
                $join->on('NAM.author_id', '=', 'AUS.id');
                $join->where('NAM.locale', '=', $locale);
            })
            ->where('POS.office', '=', 'daily')
            ->where('POS.position', '<', 20)
            ->orderBy('POS.position', 'ASC')
            ->get(array('AUS.*', 'NAM.*'));

        return $rows;
    }

    public function getStylerTop()
    {
        $locale  = app()->getLocale();
        $rows = DB::table('authors_top as POS')
            ->join('authors as AUS', 'POS.author_id', '=', 'AUS.id')
            ->join('author_names as NAM', function ($join) use ($locale) {
                $join->on('NAM.author_id', '=', 'AUS.id');
                $join->where('NAM.locale', '=', $locale);
            })
            ->where('POS.office', '=', 'styler')
            ->where('POS.position', '<', 20)
            ->orderBy('POS.position', 'ASC')
            ->get(array('AUS.*', 'NAM.*'));

        return $rows;
    }
}


