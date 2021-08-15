@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row mb-3">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Добавление дополнений</h2>
                </div>
                <div>
                    <a class="btn btn-primary" href="{{ route('additional.index') }}"> Вернуться назад</a>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <hr>
        <form action="{{route('additional.store')}}" method="POST" enctype="multipart/form-data">
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
                        <input type="radio" class="form-check-input" name="lang" value="kz">Казахский
                    </label>
                </div>
            </div>
            <div class="form-group mt-3">
                <input class="form-control"  type="text" placeholder="Описание" name="description">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Сохранить</button>
        </form>
    </div>

@endsection