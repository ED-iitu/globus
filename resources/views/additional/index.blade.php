@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-5">
            <h3>Список дополнений</h3>
        </div>
        <div>
            <a class="btn btn-success" href="{{route('additional.create')}}">Добавить дополнение</a>
        </div>
        @if($additionals->isEmpty())
            <div class="row justify-content-center">
                <h1>Список дополнений пуст</h1>
            </div>
        @else
            <ul class="list-group mt-3">
                @foreach ($additionals as $additional)
                    <li class="list-group-item d-flex justify-content-between align-items-center mt-2">
                        <a href="{{route('additional.show', $additional)}}">{{$additional->id}}</a>
                        <div>
                            {{$additional->description}}
                        </div>
                        <div>
                            {{$additional->lang}}
                        </div>
                        <div>

                            <form action="{{ route('additional.destroy',$additional->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger edit" onclick="return confirm('Вы действительно хотите удалить новость?')">Удалить</button>
                            </form>
                        </div>

                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection