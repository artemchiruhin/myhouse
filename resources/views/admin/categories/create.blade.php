@extends('layouts.app')

@section('title', 'Создать категорию')

@section('content')
    <h2 class="text-center text-green mt-5">Создать категорию</h2>
    <form method="POST" action="{{ route('admin.categories.create-category') }}">
        @csrf
        @error('formError')
        <div class="danger alert-danger p-2 mb-2 fadeInLeft">
            <i class="fas fa-times-circle"></i>
            {{ $message }}
        </div>
        @enderror
        <div class="mb-3">
            <label for="title" class="form-label">Введите название</label>
            <input type="text" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" id="title">
            @error('title')
            <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-green">Создать</button>
    </form>
    <a href="{{ route('admin.categories.categories') }}" class="btn btn-green-outline mt-3"><i class="fas fa-arrow-left"></i>&nbsp;Назад</a>
@endsection
