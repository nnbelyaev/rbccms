<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="https://bulma.io">
            <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
        </a>
        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>
    <div class="navbar-menu">
        <div class="navbar-start">
            @foreach ($allowedResources as $module => $controllers)
                @if ($module == 'default')
                    <a href="{{ route('manage.home') }}" class="navbar-item">Главная</a>
                @else
                    @php
                        $items = [];
                    @endphp
                    @foreach ($controllers as $controller => $actions)
                        @can('manage.'.$module.'.'.$controller.'.index')
                            @php
                                $items[route('manage.'.$module.'.'.$controller.'.index')] = __('manage.module-'.$module.'-'.$controller);
                            @endphp
                        @endcan
                    @endforeach
                    @if (sizeof($items))
                        <div class="navbar-item has-dropdown is-hoverable">
                            <a class="navbar-link">{{ __('manage.module-'.$module) }}</a>
                            <div class="navbar-dropdown">
                                @foreach ($items as $link => $title)
                                    <a href="{{ $link }}" class="navbar-link">{{ $title }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
        <div class="navbar-end">
            <div class="navbar-item">
                @guest
                    <div class="buttons">
                        <a href="{{ route('register') }}" class="button is-primary"><strong>Sign up</strong></a>
                        <a href="{{ route('login') }}" class="button is-light">{{ __('Login') }}</a>
                    </div>
                @else
                    <div class="dropdown" :class="{'is-active' : isUserMenuClass}">
                        <div class="dropdown-trigger">
                            <button class="button" aria-haspopup="true" aria-controls="dropdown-menu" @click="toggleUserMenuClass()">
                                <span>{{ Auth::user()->name }}</span>
                                <span class="icon is-small"><i class="fas fa-angle-down" aria-hidden="true"></i></span>
                            </button>
                        </div>
                        <div class="dropdown-menu" id="dropdown-menu" role="menu">
                            <div class="dropdown-content">
                                <a href="#" class="dropdown-item">Dropdown item</a>
                                <hr class="dropdown-divider">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>
<nav class="breadcrumb" aria-label="breadcrumbs">
    <ul>
        <li><a href="{{ route('manage.home') }}">Главная</a></li>
        <li><a href="#">Documentation</a></li>
        <li><a href="#">Components</a></li>
        <li class="is-active"><a href="#" aria-current="page">Breadcrumb</a></li>
    </ul>
</nav>