<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class DbPublicationRepository implements PublicationRepository
{
    public function getNewsTopnews(int $list_id)
    {
        $locale  = app()->getLocale();
        $rows = DB::table('publications_top as POS')
            ->join('publications as PUB', 'POS.publication_id', '=', 'PUB.id')
            ->join('publication_letters as TXT', function ($join) use ($locale) {
                $join->on('TXT.publication_id', '=', 'PUB.id');
                $join->where('TXT.locale', '=', $locale);
            })
            ->where('POS.list_id', '=', $list_id)
            ->where('POS.position', '<', 10)
            ->orderBy('POS.position', 'ASC')
            ->get(array('PUB.*', 'TXT.prefix', 'TXT.heading', 'TXT.lead'));

        return $rows;
    }

    public function getFeedLast(int $feed_id, int $limit)
    {
        $locale  = app()->getLocale();
        $rows = DB::table('publications as PUB')
            ->join('publication_feeds as FED', function ($join) use ($feed_id) {
                $join->on('FED.publication_id', '=', 'PUB.id');
                $join->where('FED.feed_id', '=', $feed_id);
            })
            ->join('publication_letters as TXT', function ($join) use ($locale) {
                $join->on('TXT.publication_id', '=', 'PUB.id');
                $join->where('TXT.locale', '=', $locale);
            })
            ->where('PUB.dtpub', '<', 'NOW()')
            ->where('PUB.status', '=', 'normal')
            ->orderBy('PUB.dtpub', 'DESC')
            ->limit($limit)
            ->get(array('PUB.*', 'TXT.prefix', 'TXT.heading', 'TXT.lead'));

        return $rows;
    }
}


