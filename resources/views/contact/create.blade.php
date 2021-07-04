@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row mb-3">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Добавление Контакта</h2>
                </div>
                <div>
                    <a class="btn btn-primary" href="{{ route('contact.index') }}"> Вернуться назад</a>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <hr>
        <form action="{{route('contact.store')}}" method="POST" enctype="multipart/form-data">
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
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="uname" placeholder="Телефон" name="phone" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="uname" placeholder="Адрес" name="address" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="uname" placeholder="Рабочее время" name="work_time" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="uname" placeholder="Социаотные сети" name="social_links" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Сохранить</button>
        </form>
    </div>

@endsection