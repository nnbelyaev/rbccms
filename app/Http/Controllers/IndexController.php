<?php

namespace App\Http\Controllers;

use App\Publication;

class IndexController extends Controller
{
    public function index()
    {
        app()->get('DataHelper')->addBannerKeyword('mainpage');
        app()->get('DataHelper')->addBannerKeyword('business');

        $portalTopnews = app()->get('PublicationRepository')->getNewsTopnews(Publication::LIST_TOP_PORTAL);
        $dailyTopnews = app()->get('PublicationRepository')->getNewsTopnews(Publication::TOP_DAILY_PORTAL);
        $liteTopnews = app()->get('PublicationRepository')->getNewsTopnews(Publication::TOP_LITE_PORTAL);
        $stylerTopnews = app()->get('PublicationRepository')->getNewsTopnews(Publication::TOP_STYLER_PORTAL);
        $videoTopnews = app()->get('PublicationRepository')->getNewsTopnews(Publication::TOP_VIDEO_PORTAL);
        $reviewTopnews = app()->get('PublicationRepository')->getNewsTopnews(Publication::TOP_NEWS_OBZOR);

        $newsFeed = app()->get('PublicationRepository')->getFeedLast(Publication::FEED_NEWS, 120);
        $companyFeed = app()->get('PublicationRepository')->getFeedLast(1, 7);
        $sportFeed = app()->get('PublicationRepository')->getFeedLast(2, 5);
        $liteFeed = app()->get('PublicationRepository')->getFeedLast(3, 16);

        $dailyTopAuthors = app()->get('AuthorRepository')->getDailyTop();

        return view('main', [
            'bodyClass' => 'home-page',
            'metatags' => $this->getMetaTags(),
            'portalTopnews' => $portalTopnews,
            'dailyTopnews' => $dailyTopnews,
            'liteTopnews' => $liteTopnews,
            'stylerTopnews' => $stylerTopnews,
            'videoTopnews' => $videoTopnews,
            'reviewTopnews' => $reviewTopnews,
            'newsFeed' => $newsFeed,
            'companyFeed' => $companyFeed,
            'sportFeed' => $sportFeed,
            'liteFeed' => $liteFeed,
            'dailyTopAuthors' => $dailyTopAuthors,
        ]);
    }

    // ToDo move to db
    private function getMetaTags() {
        return [
            'title' => 'Новости - Последние новости Украины сегодня | РБК-Украина',
            'description' => 'Последние новости Украины и мира, политические и аналитические статьи, курсы валют, индексы и котировки, интервью, мнения, бизнес новости и обзоры международных и украинского рынков.',
            'keywords' => 'новости, новости украины, новости дня, последние новости, информационное агентство, рбк, украина, rbc, rbk',
            'og:image' => 'https://www.rbc.ua/static/common/imgs/logo650.jpg',
        ];
    }
}
