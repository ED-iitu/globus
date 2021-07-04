@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Добро пожаловать в Админпанель</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(Auth::user()->role == 1)
                    <div class="flex justify-content-between">
                        <p>Всего заведений: <span style="text-align: right">{{$facilitiesCount}}</span></p>
                    </div>
                    <div class="flex justify-content-between">
                        <p>Всего Пользователей: <span style="text-align: right">{{$userCount}}</span></p>
                    </div>

                    @else
                    Salamaleikum
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
