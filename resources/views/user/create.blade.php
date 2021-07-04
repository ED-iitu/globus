@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row mb-3">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Добавление Пользователя</h2>
                </div>
                <div>
                    <a class="btn btn-primary" href="{{ route('user.index') }}"> Вернуться назад</a>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <hr>
        <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <p>Тип пользователя</p>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="role" value="1">Admin
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="role" value="2">User
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="name" placeholder="Имя пользователя" name="name" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="email" placeholder="E-mail" name="email" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="password" placeholder="Пароль" name="password" required>
            </div>

            <div class="form-group">
                Привязка к заведению
                <div class="form-group">
                    <select class="form-control" aria-label="Default select example" name="facility_id">
                        <option selected>Выберите заведение</option>
                        @foreach($facilities as $facility)
                            <option value="{{$facility->id}}">{{$facility->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>




            <button type="submit" class="btn btn-primary mt-3">Сохранить</button>
        </form>
    </div>

@endsection