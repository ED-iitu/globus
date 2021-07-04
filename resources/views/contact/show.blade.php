@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Контакт: {{$contact->address}}</h2>
                </div>
                <div>
                    <a class="btn btn-primary" href="{{ route('contact.index') }}"> Вернуться назад</a>
                    <a class="btn btn-success" href="{{ route('contact.edit', $contact) }}"> Редактировать</a>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="ml-5">
                <h4>Язык</h4>
                <p><b>{{$contact->lang}}</b></p>

                <h4>Aдрес</h4>
                <p><b>{{$contact->address}}</b></p>

                <h4>Телефон</h4>
                <p><b>{{$contact->phone}}</b></p>

                <h4>Социальные сети</h4>
                <p><b>{{$contact->social_links}}</b></p>

                <h4>Рабочее время</h4>
                <p><b>{{$contact->work_time}}</b></p>

            </div>
        </div>
    </div>
@endsection