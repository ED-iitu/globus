@extends('layouts.app')
@section('content')

    <style>
        .t-row {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-5">
            <h3>Список Пользователей</h3>
        </div>
        <div>
            <a class="btn btn-success" href="{{route('user.create')}}">Добавить Пользователя</a>
        </div>
        @if($users->isEmpty())
            <div class="row justify-content-center">
                <h1>Список Пользователей пуст</h1>
            </div>
        @else
            <ul class="list-group mt-3">
                @foreach ($users as $user)
                    <li class="list-group-item d-flex justify-content-between mt-2">
                        <div class="t-row">{{$user->name}}</div>
                        <div class="t-row">{{$user->email}}</div>
                        <div class="t-row">{{$user->role == 1 ? 'admin' : 'user'}}</div>
                        @if(count($user->facilities) > 0)
                        @foreach($user->facilities as $facility)
                            <div class="t-row">{{$facility->name}}</div>
                        @endforeach
                        @else
                            <div class="t-row">Не привязано заведение</div>
                        @endif
                        <div>
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                <a class="btn btn-primary edit" href="{{ route('user.edit', $user) }}">Изменить</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger edit" onclick="return confirm('Вы действительно хотите удалить акцию?')">Удалить</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection