@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
<h2 class="text-center text-green mt-5">Регистрация</h2>
<form method="POST" action="{{ route('registration') }}">
    @csrf
    @error('formError')
    <div class="danger alert-danger">
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
        <label for="full-name" class="form-label">Введите ФИО</label>
        <input type="text" name="full_name" value="{{ old('full_name') }}" class="form-control @error('full_name') is-invalid @enderror" id="full-name">
        @error('full_name')
        <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Введите email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="email">
        @error('email')
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
    <div class="mb-3">
        <label for="password-confirmation" class="form-label">Повторите пароль</label>
        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password-confirmation">
        @error('password_confirmation')
        <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3 form-check">
        <label class="form-check-label" for="check">Даю согласие на обработку персональных данных</label>
        <input type="checkbox" name="checkbox" class="form-check-input @error('checkbox') is-invalid @enderror" id="check">
        @error('checkbox')
        <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit" class="btn btn-green">Зарегистрироваться</button>
</form>
@endsection
