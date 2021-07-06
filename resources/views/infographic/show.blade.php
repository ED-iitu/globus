@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Информация: {{$infographic->title}}</h2>
                </div>
                <div>
                    <a class="btn btn-primary" href="{{ route('infographic.index') }}"> Вернуться назад</a>
                    <a class="btn btn-success" href="{{ route('infographic.edit', $infographic) }}"> Редактировать</a>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="ml-5">
                <h4>Язык</h4>
                <p><b>{{$infographic->lang}}</b></p>

                <h4>Заголовок</h4>
                <p><b>{{$infographic->title}}</b></p>

                <h4>Описание</h4>
                <p><b>{{$infographic->description}}</b></p>
            </div>
        </div>
    </div>
@endsection