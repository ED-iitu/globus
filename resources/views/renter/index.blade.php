@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-5">
            <h3>Список информации Арендаторам</h3>
        </div>
        <div>
            <a class="btn btn-success" href="{{route('renter.create')}}">Добавить информацию</a>
        </div>
        @if($renters->isEmpty())
            <div class="row justify-content-center">
                <h1>Список информации пуст</h1>
            </div>
        @else
            <ul class="list-group mt-3">
                @foreach ($renters as $renter)
                    <li class="list-group-item d-flex justify-content-between align-items-center mt-2">
                        <a href="{{route('renter.show', $renter)}}">{{$renter->title}}</a>
                        <div>
                            Язык: {{$renter->lang}}
                        </div>
                        <div>
                            <form action="{{ route('renter.destroy',$renter->id) }}" method="POST">
                                <a class="btn btn-primary edit" href="{{ route('renter.edit', $renter) }}">Изменить</a>
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