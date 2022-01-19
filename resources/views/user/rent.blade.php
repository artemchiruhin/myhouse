@extends('layouts.app')

@section('title', 'Аренда дома №' . $house->id)

@section('content')
    <div class="house-info">
        <div class="house-image my-2">
            <img src="{{ asset('storage/' . $house->image) }}" class="img-fluid" alt="Дом №{{ $house->id }}">
        </div>
        <h2 class="text-green mb-2">{{ $house->title }}</h2>
        <p>{{ $house->description }}</p>
        <p class="text-green">Основная информация</p>
        <ul class="list-group">
            <li class="list-group-item">Адрес: {{ $house->address }}</li>
            <li class="list-group-item">Категория: {{ $house->category->title }}</li>
            <li class="list-group-item">Комнат: {{ $house->rooms }}</li>
            <li class="list-group-item">Цена в сутки: <strong class="text-green"><span class="price-per-day">{{ $house->price_per_day }}</span> руб.</strong></li>
        </ul>
    </div>
    <h3 class="text-green mt-5">Арендовать</h3>
    <form action="{{ route('rent-house', $house->id) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md col-12">
                <label for="date-from" class="form-label">Начальная дата: </label>
                <input type="date" class="form-control @error('date_from') is-invalid @enderror" value="{{ old('date_from') }}" name="date_from" id="date-from" min="{{ date("Y-m-d", strtotime('tomorrow')) }}">
                @error('date_from')
                <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md col-12">
                <label for="date-ro" class="form-label">Конечная дата: </label>
                <input type="date" class="form-control @error('date_to') is-invalid @enderror" value="{{ old('date_to') }}" name="date_to" id="date-to" min="{{ date("Y-m-d", strtotime('tomorrow')) }}">
                @error('date_to')
                <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
                @enderror
            </div>
            @if($errors->first('date_exists'))
                <span class="text-danger fadeInLeft" role="alert">{{ $errors->first('date_exists') }}</span>
            @endif
        </div>
        <div class="mt-3">
            <h5 class="text-green">Стоимость: <span class="cost"></span></h5>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-green">Арендовать</button>
        </div>
    </form>
@endsection
