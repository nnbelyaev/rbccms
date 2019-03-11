@extends('layouts.app')

@section('content')
    <h1 class="title">Новый пользователь</h1>
    <form method="POST" action="{{ route('manage.system.user.store') }}" accept-charset="UTF-8">
        @csrf
        <div class="field">
            <label class="label">Имя пользователя</label>
            <div class="control">
                <input class="input {{ $errors->has('name') ? ' is-danger' : '' }}" type="text" name="name" placeholder="Имя пользователя" value="{{ old('name') }}" required autofocus>
            </div>
            @if ($errors->has('name'))
                <p class="help is-danger">{{ $errors->first('name') }}</p>
            @endif
        </div>
        <div class="field">
            <label class="label">Email пользователя</label>
            <div class="control">
                <input class="input {{ $errors->has('email') ? ' is-danger' : '' }}" type="email" name="email" placeholder="Email пользователя" value="{{ old('email') }}" required autofocus>
            </div>
            @if ($errors->has('email'))
                <p class="help is-danger">{{ $errors->first('email') }}</p>
            @endif
        </div>
        <div class="field">
            <label class="label">Пароль</label>
            <div class="control">
                <input class="input {{ $errors->has('password') ? ' is-danger' : '' }}" type="text" name="password" placeholder="Пароль" value="{{ old('password') }}" required>
            </div>
            @if ($errors->has('password'))
                <p class="help is-danger">{{ $errors->first('password') }}</p>
            @endif
        </div>
        <div class="field">
            <label class="label">В какие группы добавить</label>
            <div class="control">
                @foreach($roles as $role)
                    <label class="checkbox"><input type="checkbox" name="role[]" value="{{$role->id}}" @if(is_array(old('role')) && in_array($role->id, old('role'))) checked @endif /> {{ $role->name }}</label>
                @endforeach
            </div>
        </div>

        @include('manage._shared.errors')

        <div class="field is-grouped">
            <div class="control">
                <button class="button is-link">Отправить</button>
            </div>
            <div class="control">
                <a href="{{ route('manage.system.user.index') }}" class="button is-text">Отмена</a>
            </div>
        </div>
    </form>
@endsection
