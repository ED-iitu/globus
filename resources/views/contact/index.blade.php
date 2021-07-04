@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-5">
            <h3>Список контактов</h3>
        </div>
        <div>
            <a class="btn btn-success" href="{{route('contact.create')}}">Добавить контакт</a>
        </div>
        @if($contacts->isEmpty())
            <div class="row justify-content-center">
                <h1>Список контактов пуст</h1>
            </div>
        @else
            <ul class="list-group mt-3">
                @foreach ($contacts as $contact)
                    <li class="list-group-item d-flex justify-content-between align-items-center mt-2">
                        <a href="{{route('contact.show', $contact)}}">{{$contact->address}}</a>
                        <div>
                            Язык: {{$contact->lang}}
                        </div>
                        <div>
                            <form action="{{ route('contact.destroy',$contact->id) }}" method="POST">
                                <a class="btn btn-primary edit" href="{{ route('contact.edit', $contact) }}">Изменить</a>
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