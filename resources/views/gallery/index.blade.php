@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-5">
            <h3>Галерея</h3>
        </div>
        <div>
            <a class="btn btn-success" href="{{route('gallery.create')}}">Добавить галерею</a>
        </div>
        @if($galleries->isEmpty())
            <div class="row justify-content-center">
                <h1>Галерея пуста</h1>
            </div>
        @else
            <ul class="list-group mt-3">
                @foreach ($galleries as $gallery)
                    <li class="list-group-item d-flex justify-content-between align-items-center mt-2">
                        <a href="{{route('gallery.show', $gallery)}}">{{$gallery->title}}</a>
                        <div>
                            Язык: {{$gallery->lang}}
                        </div>
                        <div>
                            <form action="{{ route('gallery.destroy',$gallery->id) }}" method="POST">
                                <a class="btn btn-primary edit" href="{{ route('gallery.edit', $gallery) }}">Изменить</a>
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