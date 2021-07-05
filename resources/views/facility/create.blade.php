@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row mb-3">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Добавление заведения</h2>
                </div>
                <div>
                    <a class="btn btn-primary" href="{{ route('facility.index') }}"> Вернуться назад</a>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <hr>
        <form action="{{route('facility.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <p>Язык</p>
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
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="kz" value="en">Казахский
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="uname" placeholder="Название" name="name" required>
            </div>

            <div class="form-group">
                <textarea class="form-control" name="description" id="" rows="3" placeholder="Описание"></textarea>
            </div>

            <div class="form-group">
                <input type="text" class="form-control" id="floor" placeholder="Этаж" name="floor">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="social_url" placeholder="Ссылки на социальные сети через запятую" name="social_url">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="work_time" placeholder="Время работы" name="work_time">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" id="web_url" placeholder="Ссылка на веб-сайт" name="web_url">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" id="map_coords" placeholder="Координаты на карте" name="map_coords">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" id="order" placeholder="Сортировка" name="order">
            </div>
            <div class="form-group">
                <select class="form-control" aria-label="Default select example" name="category_id">
                    <option selected>Выберите категорию заведения</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="logo">Выберите logo</label>
                <input class="form-control" id="logo" type="file" name="logo" required>
            </div>
            <div class="form-group mt-3">
                <label for="image">Выберите Картинку</label>
                <input class="form-control" id="image" type="file" name="image" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Сохранить</button>
        </form>
    </div>

@endsection