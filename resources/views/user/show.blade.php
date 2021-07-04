@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Новость: {{$promotion->title}}</h2>
                </div>
                <div>
                    <a class="btn btn-primary" href="{{ route('promotion.index') }}"> Вернуться назад</a>
                    <a class="btn btn-success" href="{{ route('promotion.edit', $promotion) }}"> Редактировать</a>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="image-container" style="width: 300px; height: 300px">
                <img src="{{$promotion->image}}" alt="" style="max-width: 100%; max-height: 100%">
            </div>
            <div class="ml-5">
                <h4>Язык</h4>
                <p><b>{{$promotion->lang}}</b></p>

                <h4>Заголовок</h4>
                <p><b>{{$promotion->title}}</b></p>

                <h4>Link</h4>
                <p><b>{{$promotion->link}}</b></p>
            </div>
        </div>
    </div>
@endsection