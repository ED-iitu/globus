@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-5">
            <h3>Список информации о нас</h3>
        </div>
        <div>
            <a class="btn btn-success" href="{{route('about.create')}}">Добавить информацию</a>
        </div>
        @if($abouts->isEmpty())
            <div class="row justify-content-center">
                <h1>Список информации пуст</h1>
            </div>
        @else
            <ul class="list-group mt-3">
                @foreach ($abouts as $about)
                    <li class="list-group-item d-flex justify-content-between align-items-center mt-2">
                        <a href="{{route('about.show', $about)}}">{{$about->title}}</a>
                        <div>
                            Язык: {{$about->lang}}
                        </div>
                        <div>
                            <form action="{{ route('about.destroy',$about->id) }}" method="POST">
                                <a class="btn btn-primary edit" href="{{ route('about.edit', $about) }}">Изменить</a>
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