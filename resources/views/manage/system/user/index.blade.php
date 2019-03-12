@extends('layouts.app')

@section('content')
    <h1 class="title">Управление Пользователями</h1>
    <a href="{{ route('manage.system.user.create') }}" class="button is-primary m-b-30">Создать пользователя</a>

    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
        <tr>
            <th>ID</th>
            <th>Имя пользователя</th>
            <th>Email</th>
            <th>Группы</th>
            <th>Операции</th>
        </tr>
        </thead>
        <tbody>
        @forelse($users as $user)
            <tr>
                <th>{{ $user->id }}</th>
                <td><a href="{{ route('manage.system.user.edit', ['user' => $user->id]) }}">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->roles()->get()->implode('name', ', ') }}</td>
                <td>
                    <a href="{{ route('manage.system.user.edit', ['user' => $user->id]) }}" class="button is-small is-primary is-outlined">Редактировать</a>
                    <a href="javascript:;" class="button is-small is-danger is-outlined" onclick="event.preventDefault();return confirm('Точно удаляем?') ? document.getElementById('group-delete-form-{{$user->id}}').submit() : false;">Удалить</a>
                    <form id="group-delete-form-{{$user->id}}" action="{{ route('manage.system.user.destroy', ['user' => $user->id]) }}" method="POST" style="display: none;">@csrf @method('delete')</form>
                </td>
            </tr>
        @empty
            <tr><td colspan="3"><a href="{{ route('manage.system.user.create') }}" class="button is-primary">Создать пользователя</a></td></tr>
        @endforelse
        </tbody>
    </table>

@endsection
