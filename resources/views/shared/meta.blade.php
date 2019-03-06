@if(isset($metatags))
    <title>{{ isset($metatags['title']) ? $metatags['title'] : '' }}</title>
    @if (isset($metatags['description'])) <meta name="description" content="{{ $metatags['description'] }}"/> @endif
    @if (isset($metatags['keywords'])) <meta name="keywords" content="{{ $metatags['keywords'] }}"/> @endif
    @if (isset($metatags['news_keywords'])) <meta name="news_keywords" content="{{ $metatags['news_keywords'] }}"/> @endif
    @if (isset($metatags['og:title'])) <meta name="og:title" content="{{ $metatags['og:title'] }}"/> @endif
    @if (isset($metatags['og:description'])) <meta name="og:description" content="{{ $metatags['og:description'] }}"/> @endif
    @if (isset($metatags['og:url'])) <meta name="og:url" content="{{ $metatags['og:url'] }}"/> @endif
    @if (isset($metatags['og:type'])) <meta name="og:type" content="{{ $metatags['og:type'] }}"/> @endif
    @if (isset($metatags['og:image'])) <meta name="og:image" content="{{ $metatags['og:image'] }}"/> @endif
    @if (isset($metatags['og:site_name'])) <meta name="og:site_name" content="{{ $metatags['og:site_name'] }}"/> @endif
    @if (isset($metatags['og:locale'])) <meta name="og:locale" content="{{ $metatags['og:locale'] }}"/> @endif
    @if (isset($metatags['twitter:card'])) <meta name="twitter:card" content="{{ $metatags['twitter:card'] }}"/> @endif
    @if (isset($metatags['twitter:site'])) <meta name="twitter:site" content="{{ $metatags['twitter:site'] }}"/> @endif
    @if (isset($metatags['twitter:title'])) <meta name="twitter:title" content="{{ $metatags['twitter:title'] }}"/> @endif
    @if (isset($metatags['twitter:description'])) <meta name="twitter:description" content="{{ $metatags['twitter:description'] }}"/> @endif
    @if (isset($metatags['twitter:creator'])) <meta name="twitter:creator" content="{{ $metatags['twitter:creator'] }}"/> @endif
    @if (isset($metatags['twitter:image:src'])) <meta name="twitter:image:src" content="{{ $metatags['twitter:image:src'] }}"/> @endif
    @if (isset($metatags['twitter:domain'])) <meta name="twitter:domain" content="{{ $metatags['twitter:domain'] }}"/> @endif
    <link href="{{ url()->current() }}" rel="canonical"/>
    {{-- ToDo implement link for another languages pages and amp version --}}
    {{--
    <link href="https://www.rbc.ua/ukr/news/esminets-donald-cook-pokinul-port-odessy-1551288306.html" hreflang="uk" rel="alternate"/>
    <link href="https://www.rbc.ua/rus/news/esminets-donald-cook-pokinul-port-odessy-1551288306.html/amp" rel="amphtml"/>
    --}}
@endif