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
            <a class="btn btn-success" href="{{route('promotion.create')}}">Добавить Акцию</a>
        </div>
        @if($promotions->isEmpty())
            <div class="row justify-content-center">
                <h1>Список Акций пуст</h1>
            </div>
        @else
            <ul class="list-group mt-3">
                @foreach ($promotions as $promotion)
                    <li class="list-group-item d-flex justify-content-between align-items-center mt-2">
                        <a href="{{route('promotion.show', $promotion)}}">{{$promotion->title}}</a>
                        <div>
                            Язык: {{$promotion->lang}}
                        </div>

                        <div>

                            <form action="{{ route('promotion.destroy',$promotion->id) }}" method="POST">
                                <a class="btn btn-primary edit" href="{{ route('promotion.edit', $promotion) }}">Изменить</a>
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