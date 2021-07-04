@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Заведение: {{$facility->name}}</h2>
                </div>
                <div>
                    <a class="btn btn-primary" href="{{ route('facility.index') }}"> Вернуться назад</a>
                    <a class="btn btn-success" href="{{ route('facility.edit', $facility) }}"> Редактировать</a>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="image-container" style="width: 300px; height: 300px">
                <img src="{{$facility->image}}" alt="" style="max-width: 100%; max-height: 100%">
            </div>
            <div class="image-container" style="width: 300px; height: 300px">
                <img src="{{$facility->logo}}" alt="" style="max-width: 100%; max-height: 100%">
            </div>
            <div class="ml-5">
                <h4>Язык</h4>
                <p><b>{{$facility->lang}}</b></p>

                <h4>Описание</h4>
                <p><b>{{$facility->description}}</b></p>
            </div>
        </div>
    </div>
@endsection