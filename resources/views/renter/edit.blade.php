@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row mb-3">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Обновление информации</h2>
                </div>
                <div>
                    <a class="btn btn-primary" href="{{ route('renter.index') }}"> Вернуться назад</a>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <hr>
        <form action="{{route('renter.update', $renter)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <input type="text" class="form-control" id="uname" placeholder="Заголовок" name="title" required value="{{$renter->title}}">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" id="uname" placeholder="Описание" name="description" required value="{{$renter->description}}">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" id="uname" placeholder="Телефон" name="phone" required value="{{$renter->phone}}">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Обновить</button>
        </form>
    </div>

@endsection