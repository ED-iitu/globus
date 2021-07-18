@extends('layouts.app')

@section('content')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <div class="container">

        <div class="row mb-3">
            <div class="col-lg-12 margin-tb">
                <div>
                    <h2>Добавление Галереи</h2>
                </div>

                <div>
                    <a class="btn btn-primary" href="{{ route('gallery.index') }}"> Вернуться назад</a>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <hr>

        <form method="post" action="{{route('gallery.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="text" name="title" class="form-control" placeholder="Название">
            </div>

            <div class="form-group">
                <label for="">Основная картинка</label>
                <input type="file" name="main_image" class="form-control">
            </div>

            <label for="">Картинки внутри галереи</label>
            <div class="input-group control-group increment" >

                <input type="file" name="filename[]" class="form-control">
                <div class="input-group-btn">
                    <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                </div>
            </div>
            <div class="clone hide">
                <div class="control-group input-group" style="margin-top:10px">
                    <input type="file" name="filename[]" class="form-control">
                    <div class="input-group-btn">
                        <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>

        </form>


        {{--<form action="{{route('gallery.store')}}" method="POST" enctype="multipart/form-data">--}}
            {{--@csrf--}}
            {{--<div class="form-group">--}}
                {{--<p>Язык категории</p>--}}
                {{--<div class="form-check-inline">--}}
                    {{--<label class="form-check-label">--}}
                        {{--<input type="radio" class="form-check-input" name="lang" value="ru">Русский язык--}}
                    {{--</label>--}}
                {{--</div>--}}
                {{--<div class="form-check-inline">--}}
                    {{--<label class="form-check-label">--}}
                        {{--<input type="radio" class="form-check-input" name="lang" value="en">English--}}
                    {{--</label>--}}
                {{--</div>--}}
                {{--<div class="form-check-inline">--}}
                    {{--<label class="form-check-label">--}}
                        {{--<input type="radio" class="form-check-input" name="lang" value="kz">Казахский--}}
                    {{--</label>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="form-group">--}}
                {{--<input type="text" class="form-control" id="uname" placeholder="Заголовок" name="title" required>--}}
            {{--</div>--}}
            {{--<div class="form-group">--}}
                {{--<input type="text" class="form-control" id="uname" placeholder="Описание" name="description" required>--}}
            {{--</div>--}}
            {{--<button type="submit" class="btn btn-primary mt-3">Сохранить</button>--}}
        {{--</form>--}}
    </div>

    <script type="text/javascript">

        $(document).ready(function() {

            $(".btn-success").click(function(){
                var html = $(".clone").html();
                $(".increment").after(html);
            });

            $("body").on("click",".btn-danger",function(){
                $(this).parents(".control-group").remove();
            });

        });

    </script>

@endsection