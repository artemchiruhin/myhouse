@extends('layouts.app')

@section('title', 'MyHouse')

@section('content')
    <h2 class="text-green mt-4">Все дома</h2>
    <form action="" method="GET" class="filter-form mb-3">
        <label for="category" class="form-label">Фильтр по категориям: </label>
        <select class="form-select filter-select" name="category" id="category">
            <option value="all" selected>Все</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @if($category->id == Request::get('category')) selected @endif>{{ $category->title }}</option>
            @endforeach
        </select>
    </form>
    @if (\Illuminate\Support\Facades\Session::has('orderAccepted'))
        <div class="alert alert-success mt-3">
            <i class="far fa-check-circle"></i>
            {{ \Illuminate\Support\Facades\Session::get('orderAccepted') }}
        </div>
    @endif
    <div class="houses">
        @if(count($houses) > 0)
            @foreach($houses as $index => $house)
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/' . $house->image) }}" class="img-fluid rounded-start" alt="{{ $house->title }}">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h4 class="card-title text-green">{{ $house->title }}</h4>
                                <p class="card-text">{{ $house->description }}</p>
                                <p class="card-text">Адрес: {{ $house->address }}</p>
                                <p class="card-text">Категория: {{ $house->category->title }}</p>
                                <p class="card-text">Комнат: {{ $house->rooms }}</p>
                                <p class="card-text">За сутки: {{ $house->price_per_day }} руб.</p>
                                <p class="card-text"><small class="text-green"><em>Создано: {{ $house->created_at->format('d.m.Y') }} в {{ $house->created_at->format('H:i') }}</em></small></p>
                                <a href="{{ route('rent-house', $house->id) }}" class="btn btn-green">Арендовать</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
                {{ $houses->withQueryString()->links('layouts.pagination') }}
        @else
            <h4 class="text-center">Домов нет.</h4>
        @endif
    </div>
@endsection
