@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-5">
            <h3>Список заведений</h3>
        </div>
        <div>
            <a class="btn btn-success" href="{{route('facility.create')}}">Добавить заведение</a>
        </div>
        @if($facilities->isEmpty())
            <div class="row justify-content-center">
                <h1>Список заведений пуст</h1>
            </div>
        @else
            <ul class="list-group mt-3">
                @foreach ($facilities as $facility)
                    <li class="list-group-item d-flex justify-content-between align-items-center mt-2">
                        <a href="{{route('facility.show', $facility)}}">{{$facility->name}}</a>
                        <div>Язык: <strong>{{$facility->lang}}</strong></div>
                        <div>

                            <form action="{{ route('facility.destroy',$facility->id) }}" method="POST">
                                <a class="btn btn-primary edit" href="{{ route('facility.edit', $facility) }}">Изменить</a>
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