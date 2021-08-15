@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Новость: {{$additional->id}}</h2>
                </div>
                <div>
                    <a class="btn btn-primary" href="{{ route('additional.index') }}"> Вернуться назад</a>
                    <a class="btn btn-success" href="{{ route('additional.edit', $additional) }}"> Редактировать</a>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div>
                {{$additional->description}}
            </div>
            <div class="ml-5">
                <h4>Язык</h4>
                <p><b>{{$additional->lang}}</b></p>
            </div>
        </div>
    </div>
@endsection