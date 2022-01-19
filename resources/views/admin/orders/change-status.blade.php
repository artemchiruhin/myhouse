@extends('layouts.app')

@section('title', 'Изменить статус заказа №' . $order->id)

@section('content')
    <h2 class="text-center text-green mt-5">Изменить статус заказа №{{ $order->id }}</h2>
    <form action="{{ route('admin.orders.change-status-order', $order->id) }}" method="POST" class="mx-1">
        @csrf
        @error('formError')
        <div class="danger alert-danger p-2 mb-2 fadeInLeft">
            <i class="fas fa-times-circle"></i>
            {{ $message }}
        </div>
        @enderror
        <div class="mb-3">
            <label for="status" class="form-label">Выберите статус</label>
            <select name="status" class="select-status form-select @error('status') is-invalid @enderror">
                @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{ $status->title }}</option>
                @endforeach
            </select>
            @error('status')
            <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3 comment-container">
            <label for="comment" class="form-label">Введите сообщение</label>
            <textarea name="comment" class="form-control @error('comment') is-invalid @enderror" id="comment" rows="3">{{ old('comment') }}</textarea>
            @error('comment')
            <span class="invalid-feedback fadeInLeft" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-green">Изменить</button>
    </form>
    <a href="{{ route('admin.orders.orders') }}" class="btn btn-green-outline mt-3"><i class="fas fa-arrow-left"></i>&nbsp;Назад</a>
@endsection
