@extends('layouts.app')

@section('content')
    <h1 class="title">Новая группа пользователей</h1>
    <form method="POST" action="{{ route('manage.system.group.store') }}" accept-charset="UTF-8">
        @csrf
        <div class="field">
            <label class="label">Название группы</label>
            <div class="control">
                <input class="input" type="text" name="name" placeholder="Название группы">
            </div>
        </div>
        <div class="field">
            <label class="label">Описание группы</label>
            <div class="control">
                <input class="input is-danger" type="text" name="label" placeholder="Описание группы" value="">
            </div>
            <p class="help is-danger">This email is invalid</p>
        </div>
        <div class="field">
            <label class="label">Права доступа</label>
            <div class="control">
                <ul>
                    @foreach ($allowedResources as $module => $controllers)
                        <li>
                            {{ $module }}
                            <ul>
                                @foreach ($controllers as $controller => $methods)
                                    <li>
                                        {{ $controller }}
                                        @foreach ($methods as $method)
                                            <span>
                                                <label><input type="checkbox"> {{$module.'.'.$controller.'.'.$method}}</label>
                                            </span>
                                        @endforeach
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
                <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
            </div>
        </div>

        <div class="field is-grouped">
            <div class="control">
                <button class="button is-link">Отправить</button>
            </div>
            <div class="control">
                <a href="{{ route('manage.system.group.index') }}" class="button is-text">Отмена</a>
            </div>
        </div>
    </form>
@endsection
