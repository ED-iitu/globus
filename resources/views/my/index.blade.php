@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-5">
            <h3>Мои заведения</h3>
        </div>
        @if(!$user)
            <div class="row justify-content-center">
                <h1>Список заведений пуст</h1>
            </div>
        @else
            <ul class="list-group mt-3">
                @foreach ($user->facilities as $my)
                    <li class="list-group-item d-flex justify-content-between align-items-center mt-2">
                        <a href="{{route('my.show', $my->id)}}">{{$my->name}}</a>
                        <div>Язык: <strong>{{$my->lang == 'ru' ? "Русский" : "English"}}</strong></div>
                        <div>

                        <a class="btn btn-primary edit" href="{{ route('my.edit', $my) }}">Изменить</a>

                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection