@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row mb-3">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Добавление Акции</h2>
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
        <form action="{{route('promotion.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
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
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="kz" value="en">Казахский
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="title" placeholder="Заголовок" name="title" required>
            </div>
            <div class="form-group">
                <label for="">Для форматирование текста используйте html теги</label>
                {{--<input type="text" class="form-control" id="link" placeholder="Ссылка" name="link" required>--}}
                <textarea class="form-control" name="description" id="" cols="30" rows="10" placeholder="Описание"></textarea>
            </div>
            <div class="form-group mt-3">
                <label for="image">Выберите картинку</label>
                <input id="image" type="file" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Сохранить</button>
        </form>
    </div>

@endsection