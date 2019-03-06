<?php

namespace App\Repositories;

interface PublicationRepository {

    public function getNewsTopnews(int $list_id);

    public function getFeedLast(int $feed_id, int $limit);

}

