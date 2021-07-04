@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Акция: {{$promotion->title}}</h2>
                </div>
                <div>
                    <a class="btn btn-primary" href="{{ route('promotion.index') }}"> Вернуться назад</a>
                    <a class="btn btn-success" href="{{ route('promotion.edit', $promotion) }}"> Редактировать</a>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="ml-5">
                <img src="{{$promotion->image}}" alt="" style="max-width: 100%; max-height: 100%">
                <br><br><br>
                <h4>Язык</h4>
                <p><b>{{$promotion->lang}}</b></p>

                <h4>Заголовок</h4>
                <p><b>{{$promotion->title}}</b></p>

                <h4>Описание</h4>
                <p>{!! $promotion->description !!}</p>
            </div>
        </div>
    </div>
@endsection