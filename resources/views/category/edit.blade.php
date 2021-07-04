@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row mb-3">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Обновление категории</h2>
                </div>
                <div>
                    <a class="btn btn-primary" href="{{ route('category.index') }}"> Вернуться назад</a>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <hr>
        <form action="{{route('category.update', $category)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <input type="text" class="form-control" id="uname" placeholder="Заголовок" name="title" required value="{{$category->title}}">
            </div>
            <div style="width: 300px; height: 300px" class="mt-5">
                <img src="{{$category->image}}" alt="" style="max-height: 100%">
            </div>

            <div class="form-group mt-3">
                <label for="image">Выберите картинку</label>
                <input id="image" type="file" name="image">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Обновить</button>
        </form>
    </div>

@endsection