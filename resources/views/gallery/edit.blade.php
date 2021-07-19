@extends('layouts.app')

@section('content')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <div class="container">

        <div class="row mb-3">
            <div class="col-lg-12 margin-tb">
                <div>
                    <h2>Обновление галереи</h2>
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
        <form action="{{route('gallery.update', $gallery)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <input type="text" name="title" class="form-control" placeholder="Название" value="{{$gallery->title}}">
            </div>

            <div class="form-group">
                <label for="">Основная картинка</label>
                <img src="{{$gallery->main_image}}" alt="" style="width: 300px; height: 300px">
                <input type="file" name="main_image" class="form-control">
            </div>

            <label for="">Картинки внутри галереи</label>
            @foreach($images as $image)
                <img src="{{$image}}" alt="" style="width: 300px; height: 300px">
            @endforeach
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