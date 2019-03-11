@extends('layouts.app')

@section('content')
    <h1 class="title">Новая группа пользователей</h1>
    <form method="POST" action="{{ route('manage.system.group.store') }}" accept-charset="UTF-8">
        @csrf
        <div class="field">
            <label class="label">Название группы</label>
            <div class="control">
                <input class="input {{ $errors->has('name') ? ' is-danger' : '' }}" type="text" name="name" placeholder="Название группы" value="{{ old('name') }}" required autofocus>
            </div>
            @if ($errors->has('name'))
                <p class="help is-danger">{{ $errors->first('name') }}</p>
            @endif
        </div>
        <div class="field">
            <label class="label">Описание группы</label>
            <div class="control">
                <input class="input {{ $errors->has('label') ? ' is-danger' : '' }}" type="text" name="label" placeholder="Описание группы" value="{{ old('label') }}" required>
            </div>
            @if ($errors->has('label'))
                <p class="help is-danger">{{ $errors->first('label') }}</p>
            @endif
        </div>
        <div class="field">
            <label class="label">Права доступа</label>
            <div class="control" style="margin-bottom: 60px">
                <ul>
                    @foreach ($allowedResources as $module => $controllers)
                        <li>
                            <span><strong>{{ $module }}</strong></span>
                            <ul style="padding-left:40px;">
                                @foreach ($controllers as $controller => $methods)
                                    <li>
                                        <span><strong>{{ $controller }}</strong></span>
                                        <ul style="padding-left:40px;">
                                            @foreach ($methods as $method)
                                                <span style="display: inline-block;margin-right:20px;">
                                                    <label><input name="permission[]" value="{{ $module.'|'.$controller.'|'.$method}}" type="checkbox"> {{$module.'.'.$controller.'.'.$method}}</label>
                                                </span>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        @include('manage._shared.errors')

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
