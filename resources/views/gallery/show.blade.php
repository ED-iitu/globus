@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Галерея: {{$gallery->title}}</h2>
                </div>
                <div>
                    <a class="btn btn-primary" href="{{ route('gallery.index') }}"> Вернуться назад</a>
                    <a class="btn btn-success" href="{{ route('gallery.edit', $gallery) }}"> Редактировать</a>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="ml-5">
                <h4>Язык</h4>
                <p><b>{{$gallery->lang}}</b></p>

                <h4>Заголовок</h4>
                <p><b>{{$gallery->title}}</b></p>

                <h4>Основная картинка</h4>
                <div class="image-container" style="width: 300px; height: 300px">
                    <img src="{{$gallery->main_image}}" alt="" style="max-height: 100%">
                </div>

                <h4>Картинки галереи</h4>
                <div class="image-container">
                    @foreach($images as $image)
                        <img src="{{$image}}" alt="" style="width: 300px; height: 300px">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection