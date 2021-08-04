@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-5">
            <h3>Список карт</h3>
        </div>
        <div>
            <a class="btn btn-success" href="{{route('map.create')}}">Добавить карту</a>
        </div>
        @if($maps->isEmpty())
            <div class="row justify-content-center">
                <h1>Список карт пуст</h1>
            </div>
        @else
            <ul class="list-group mt-3">
                @foreach ($maps as $map)
                    <li class="list-group-item d-flex justify-content-between align-items-center mt-2">
                        <a href="{{route('map.show', $map)}}">{{$map->floor}} этаж</a>
                        <div>
                            <img src="{{$map->image}}" alt="" width="500" height="300">
                        </div>
                        <div>
                            <form action="{{ route('map.destroy',$map->id) }}" method="POST">
                                <a class="btn btn-primary edit" href="{{ route('map.edit', $map) }}">Изменить</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger edit" onclick="return confirm('Вы действительно хотите удалить информацию?')">Удалить</button>
                            </form>
                        </div>

                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection