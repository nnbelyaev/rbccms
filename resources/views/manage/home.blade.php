@extends('layouts.app')

@section('content')
    <article class="message">
        <div class="message-header"><p>Dashboard</p></div>
        <div class="message-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            You are logged in!
            @can('test')
                <a href="dsfsd">dsfsdfdfds</a>
            @endcan

        </div>
    </article>
@endsection
