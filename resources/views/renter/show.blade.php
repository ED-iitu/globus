@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Информация: {{$renter->title}}</h2>
                </div>
                <div>
                    <a class="btn btn-primary" href="{{ route('renter.index') }}"> Вернуться назад</a>
                    <a class="btn btn-success" href="{{ route('renter.edit', $renter) }}"> Редактировать</a>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="ml-5">
                <h4>Язык</h4>
                <p><b>{{$renter->lang}}</b></p>

                <h4>Заголовок</h4>
                <p><b>{{$renter->title}}</b></p>

                <h4>Описание</h4>
                <p><b>{{$renter->description}}</b></p>

                <h4>Телефон</h4>
                <p><b>{{$renter->phone}}</b></p>
            </div>
        </div>
    </div>
@endsection