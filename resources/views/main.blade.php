@extends('layouts.main')

@section('leftsidebar')
    <h3 class="widget-heading"><a href="{{ route('news') }}">{{ __('general.news') }} </a></h3>
    <div class="news-feed">
        @forelse($newsFeed as $publication)
            <div class="news-feed-item">
                <a href="{{ $dataHelper->wrPublicationUrl($publication) }}">
                    <span class="time">12:10</span>
                    {{ $publication->heading }}
                </a>
            </div>
        @empty
            empty
        @endforelse
        <a href="{{ route('news.all') }}">{{ __('general.all news') }} </a>
    </div>
@endsection

@section('content')

    bannerkeywords test - {{ $dataHelper->getBannerKeywords() }}
    <br/><br/>

    portalTopnews test<br/>
    @foreach($portalTopnews as $publication)
        <li>{{ $publication->heading }}</li>
    @endforeach

    <br/><br/>

    dailyTopnews test<br/>

    @forelse($dailyTopnews as $publication)
        <li>{{ $publication->heading }}</li>
    @empty
        empty
    @endforelse

    <br/><br/>


    $liteTopnews test<br/>

    @forelse($liteTopnews as $publication)
        <li>{{ $publication->heading }}</li>
    @empty
        empty
    @endforelse

    <br/><br/>

    $stylerTopnews test<br/>

    @forelse($stylerTopnews as $publication)
        <li>{{ $publication->heading }}</li>
    @empty
        empty
    @endforelse

    <br/><br/>

    $videoTopnews test<br/>

    @forelse($videoTopnews as $publication)
        <li>{{ $publication->heading }}</li>
    @empty
        empty
    @endforelse

    <br/><br/>

    $reviewTopnews test<br/>

    @forelse($reviewTopnews as $publication)
        <li>{{ $publication->heading }}</li>
    @empty
        empty
    @endforelse

    <br/><br/>

    $liteFeed test<br/>

    @forelse($liteFeed as $publication)
        <li>{{ $publication->heading }}</li>
    @empty
        empty
    @endforelse

    <br/><br/>

    $sportFeed test<br/>

    @forelse($sportFeed as $publication)
        <li>{{ $publication->heading }}</li>
    @empty
        empty
    @endforelse

    <br/><br/>

    $companyFeed test<br/>

    @forelse($companyFeed as $publication)
        <li>{{ $publication->heading }}</li>
    @empty
        empty
    @endforelse

    <br/><br/>




    $dailyTopAuthors test<br/>

    @forelse($dailyTopAuthors as $author)
        <li>{{ $author->name }} [{{ $author->regalia }}]</li>
    @empty
        empty
    @endforelse

    <br/><br/>


@endsection