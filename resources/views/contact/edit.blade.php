@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row mb-3">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Обновление контакта</h2>
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
        <form action="{{route('contact.update', $contact)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <p>Язык Контакта</p>
                <p>Текущий язык: {{$contact->lang}}</p>
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
                <input type="text" class="form-control" id="uname" placeholder="Телефон" name="phone" required value="{{$contact->phone}}">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="uname" placeholder="Адрес" name="address" required value="{{$contact->address}}">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="uname" placeholder="Рабочее время" name="work_time" required value="{{$contact->work_time}}">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="uname" placeholder="Социаотные сети" name="social_links" required value="{{$contact->social_links}}">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Обновить</button>
        </form>
    </div>

@endsection