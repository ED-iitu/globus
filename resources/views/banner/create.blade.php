@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row mb-3">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Добавление баннера</h2>
                </div>
                <div>
                    <a class="btn btn-primary" href="{{ route('banner.index') }}"> Вернуться назад</a>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <hr>
        <form action="{{route('banner.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mt-3">
                <label for="image">Выберите картинку</label>
                <input id="image" type="file" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Сохранить</button>
        </form>
    </div>

@endsection