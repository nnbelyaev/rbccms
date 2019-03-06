<?php

namespace App\Repositories;

use Illuminate\Contracts\Cache\Repository as Cache;

class CachingRubricRepository implements RubricRepository
{
    private $repository;
    private $cache;

    public function __construct(RubricRepository $repository, Cache $cache)
    {
        $this->repository = $repository;
        $this->cache = $cache;
    }

    public function getRubricDict()
    {
        $res = $this->cache->tags('rubrics')->rememberForever('rubrics.dict.'.app()->getLocale(), function() {
            return $this->repository->getRubricDict();
        });
        return $res;
    }
}