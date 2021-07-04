@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-5">
            <h3>Список Баннеров</h3>
        </div>
        <div>
            <a class="btn btn-success" href="{{route('banner.create')}}">Добавить баннер</a>
        </div>
        @if($banners->isEmpty())
            <div class="row justify-content-center">
                <h1>Список баннеров пуст</h1>
            </div>
        @else
            <ul class="list-group mt-3">
                @foreach ($banners as $banner)
                    <li class="list-group-item d-flex justify-content-between align-items-center mt-2">
                        <a href="{{route('banner.show', $banner)}}">{{$banner->id}}</a>
                        <div style="width: 400px; height: 300px; display: flex; justify-content: center;align-items: center">
                            <img src="{{$banner->url}}" alt="" style="max-width: 100%">
                        </div>
                        <div>

                            <form action="{{ route('banner.destroy',$banner->id) }}" method="POST">
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