@extends('layouts.app')

@section('title', 'Добавить дом')

@section('content')
    <h2 class="text-center text-green mt-5">Добавить дом</h2>
    <form method="POST" action="{{ route('admin.houses.edit-house', $house->id) }}" enctype="multipart/form-data">
        @csrf
        @error('formError')
        <div class="danger alert-danger p-2 mb-2 fadeInLeft">
            <i class="fas fa-times-circle"></i>
            {{ $message }}
        </div>
        @enderror
        <div class="mb-3">
            <label for="title" class="form-label">Введите название</label>
            <input type="text" name="title" value="{{ $house->title }}" class="form-control @error('title') is-invalid @enderror" id="title">
            @error('title')
            <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Введите описание</label>
            <textarea class="form-control @error('title') is-invalid @enderror" name="description" rows="3" id="description">{{ $house->description }}</textarea>
            @error('description')
            <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Введите адрес</label>
            <input type="text" name="address" value="{{ $house->address }}" class="form-control @error('address') is-invalid @enderror" id="address">
            @error('address')
            <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="rooms" class="form-label">Количество комнат</label>
            <input type="text" name="rooms" value="{{ $house->rooms }}" class="form-control @error('rooms') is-invalid @enderror" id="rooms">
            @error('rooms')
            <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Выберите категорию</label>
            <select class="form-select @error('category_id') is-invalid @enderror" id="category" name="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($house->category_id === $category->id) selected @endif>{{ $category->title }}</option>
                @endforeach
            </select>
            @error('category_id')
            <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price-per-day" class="form-label">Цена в день</label>
            <input type="text" name="price_per_day" value="{{ $house->price_per_day }}" class="form-control @error('price_per_day') is-invalid @enderror" id="price-per-day">
            @error('price_per_day')
            <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Выберите файл</label>
            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image">
            @error('image')
            <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-green">Изменить</button>
    </form>
    <a href="{{ route('admin.houses.houses') }}" class="btn btn-green-outline mt-3"><i class="fas fa-arrow-left"></i>&nbsp;Назад</a>
@endsection
