@extends('layouts.app')

@section('title', 'Вход')

@section('content')
    <h2 class="text-center text-green mt-5">Авторизация</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        @error('incorrect_user')
        <div class="danger alert-danger p-2 mb-2 fadeInLeft">
            <i class="fas fa-times-circle"></i>
            {{ $message }}
        </div>
        @enderror
        <div class="mb-3">
            <label for="login" class="form-label">Введите логин</label>
            <input type="text" name="login" value="{{ old('login') }}" class="form-control @error('login') is-invalid @enderror" id="login">
            @error('login')
            <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Введите пароль</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
            @error('password')
            <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-green">Войти</button>
    </form>
@endsection
