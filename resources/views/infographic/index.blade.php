@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-5">
            <h3>Список инфографики</h3>
        </div>
        <div>
            <a class="btn btn-success" href="{{route('infographic.create')}}">Добавить информацию</a>
        </div>
        @if($infographics->isEmpty())
            <div class="row justify-content-center">
                <h1>Список инфографики пуст</h1>
            </div>
        @else
            <ul class="list-group mt-3">
                @foreach ($infographics as $infographic)
                    <li class="list-group-item d-flex justify-content-between align-items-center mt-2">
                        <a href="{{route('infographic.show', $infographic)}}">{{$infographic->title}}</a>
                        <div>
                            Язык: {{$infographic->lang}}
                        </div>
                        <div>
                            <form action="{{ route('infographic.destroy',$infographic->id) }}" method="POST">
                                <a class="btn btn-primary edit" href="{{ route('infographic.edit', $infographic) }}">Изменить</a>
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