<?php

namespace App\Repositories;

use Illuminate\Contracts\Cache\Repository as Cache;

class CachingAuthorRepository implements AuthorRepository
{
    private $repository;
    private $cache;

    public function __construct(AuthorRepository $repository, Cache $cache)
    {
        $this->repository = $repository;
        $this->cache = $cache;
    }

    public function getAuthorDict()
    {
        $res = $this->cache->tags('authors')->rememberForever('auhtors.dict.'.app()->getLocale(), function() {
            return $this->repository->getAuthorDict();
        });
        return $res;
    }

    public function getDailyTop()
    {
        $res = $this->cache->tags(['authors', 'authors.top.daily'])->rememberForever('authors.top.daily.'.app()->getLocale(), function() {
            return $this->repository->getDailyTop();
        });
        return $res;
    }

    public function getStylerTop()
    {
        $res = $this->cache->tags(['authors', 'authors.top.styler'])->rememberForever('authors.top.styler.'.app()->getLocale(), function() {
            return $this->repository->getStylerTop();
        });
        return $res;
    }
}