@extends('admin.index')

@section('admin-content')
    <h2 class="text-green mb-3">Дома</h2>
    <a href="{{ route('admin.houses.create-house') }}" class="btn btn-green"><i class="fas fa-plus"></i>&nbsp;Добавить</a>
    @if (\Illuminate\Support\Facades\Session::has('houseCreated'))
        <div class="alert alert-success mt-3">
            <i class="fas fa-check-circle"></i>
            {{ \Illuminate\Support\Facades\Session::get('houseCreated') }}
        </div>
    @endif
    @if (\Illuminate\Support\Facades\Session::has('houseUpdated'))
        <div class="alert alert-info mt-3">
            <i class="fas fa-info-circle"></i>
            {{ \Illuminate\Support\Facades\Session::get('houseUpdated') }}
        </div>
    @endif
    @if (\Illuminate\Support\Facades\Session::has('houseDeleted'))
        <div class="alert alert-danger mt-3">
            <i class="fas fa-times-circle"></i>
            {{ \Illuminate\Support\Facades\Session::get('houseDeleted') }}
        </div>
    @endif
    <div class="mt-3">
        @if(count($houses) > 0)
        @foreach($houses as $index => $house)
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ asset('storage/' . $house->image) }}" class="img-fluid rounded-start" alt="{{ $house->title }}">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title text-green">{{ $house->title }}</h5>
                            <p class="card-text">{{ $house->description }}</p>
                            <p class="card-text">Адрес: {{ $house->address }}</p>
                            <p class="card-text">Категория: {{ $house->category->title }}</p>
                            <p class="card-text">Комнат: {{ $house->rooms }}</p>
                            <p class="card-text">За сутки: {{ $house->price_per_day }} руб.</p>
                            <p class="card-text"><small class="text-green"><em>Создано: {{ $house->created_at->format('d.m.Y') }} в {{ $house->created_at->format('H:i') }}</em></small></p>
                            <div class="card-buttons d-flex">
                                <a href="{{ route('admin.houses.edit-house', $house->id) }}" class="btn btn-primary mx-1">Изменить</a>
                                <form action="{{ route('admin.houses.delete-house', $house->id) }}" method="POST" class="mx-1">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger">Удалить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            {{ $houses->withQueryString()->links('layouts.pagination') }}
            @else
            <h4 class="text-center">Домов пока нет.</h4>
        @endif
    </div>
@endsection
