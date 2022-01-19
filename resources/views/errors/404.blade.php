@extends('layouts.app')

@section('title', 'Страница не найдена')
@section('content')
    <h1 class="display-1 text-green text-center mt-5">404 :(</h1>
    <p class="text-center mt-4">Страница не найдена. Вернуться на <a href="{{ route('index') }}" class="text-green text-decoration-none">главную</a></p>
@endsection
