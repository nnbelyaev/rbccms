@extends('layouts.app')

@section('content')
    <h1 class="title">Управление группами пользователей</h1>
    <a href="{{ route('manage.system.group.create') }}" class="button is-primary">Создать группу</a>

    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
        <tr>
            <th>ID</th>
            <th>Название группы</th>
            <th>Описание</th>
            <th>Операции</th>
        </tr>
        </thead>
        <tbody>
        @forelse($roles as $role)
        <tr>
            <th>{{ $role->id }}</th>
            <td><a href="{{ route('manage.system.group.edit', ['group' => $role->id]) }}">{{ $role->name }}</a></td>
            <td>{{ $role->label }}</td>
            <td>
                <a href="{{ route('manage.system.group.edit', ['group' => $role->id]) }}" class="button is-small is-primary is-outlined">Редактировать</a>
                <a href="javascript:;" class="button is-small is-danger is-outlined" onclick="event.preventDefault();return confirm('Точно удаляем?') ? document.getElementById('group-delete-form-{{$role->id}}').submit() : false;">Удалить</a>
                <form id="group-delete-form-{{$role->id}}" action="{{ route('manage.system.group.destroy', ['group' => $role->id]) }}" method="POST" style="display: none;">@csrf @method('delete')</form>
            </td>
        </tr>
        @empty
            <tr><td colspan="3"><a href="{{ route('manage.system.group.create') }}" class="button is-primary">Создать группу</a></td></tr>
        @endforelse
    </tbody>
    </table>

@endsection
