@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-5">
            <h3>Список категорий</h3>
        </div>
        <div>
            <a class="btn btn-success" href="{{route('category.create')}}">Добавить категорию</a>
        </div>
        @if($categories->isEmpty())
            <div class="row justify-content-center">
                <h1>Список категорий пуст</h1>
            </div>
        @else
            <ul class="list-group mt-3">
                @foreach ($categories as $category)
                    <li class="list-group-item d-flex justify-content-between align-items-center mt-2">
                        <a href="{{route('category.show', $category)}}">{{$category->title}}</a>
                        <div>
                            Язык: {{$category->lang}}
                        </div>
                        <div>
                            <form action="{{ route('category.destroy',$category->id) }}" method="POST">
                                <a class="btn btn-primary edit" href="{{ route('category.edit', $category) }}">Изменить</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger edit" onclick="return confirm('Вы действительно хотите удалить новость?')">Удалить</button>
                            </form>
                        </div>

                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection