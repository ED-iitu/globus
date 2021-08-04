@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row mb-3">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Обновление карты</h2>
                </div>
                <div>
                    <a class="btn btn-primary" href="{{ route('map.index') }}"> Вернуться назад</a>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <hr>
        <form action="{{route('map.update', $map)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <input type="text" class="form-control" id="uname" placeholder="Заголовок" name="floor" required value="{{$map->floor}}">
            </div>
            <div class="form-group">
                <img src="{{$map->image}}" alt="" height="300" width="500">
            </div>

            <div class="form-group">
                <label for="image">Выберите картинку</label>
                <input id="image" type="file" name="image">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Обновить</button>
        </form>
    </div>

@endsection