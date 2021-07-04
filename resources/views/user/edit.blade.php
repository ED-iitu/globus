@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row mb-3">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Обновление категории</h2>
                </div>
                <div>
                    <a class="btn btn-primary" href="{{ route('promotion.index') }}"> Вернуться назад</a>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <hr>
        <form action="{{route('promotion.update', $promotion)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <p>Язык категории</p>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="lang" value="ru">Русский язык
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="lang" value="en">English
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="title" placeholder="Заголовок" name="title" value="{{$promotion->title}}" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="link" placeholder="Ссылка" name="link" value="{{$promotion->link}}" required>
            </div>
            <div class="form-group">
                <img src="{{$promotion->image}}" alt="">
            </div>
            <div class="form-group mt-3">
                <label for="image">Выберите картинку</label>
                <input id="image" type="file" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Сохранить</button>
        </form>
    </div>

@endsection