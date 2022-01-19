@extends('layouts.app')

@section('title', 'Ваш профиль')

@section('content')
    <h2 class="text-green mt-4">Добро пожаловать, {{ $user->full_name }}!</h2>
    <p>Это ваш профиль</p>
    <h3 class="text-green mt-5">История заказов</h3>
    @if(count($orders) > 0)
        <div class="user-orders-table-container">
            <table class="table orders-table mt-4">
                <thead>
                <tr class="text-green">
                    <th>№</th>
                    <th>Дом</th>
                    <th>Стоимость</th>
                    <th>Статус</th>
                    <th>Дата начала</th>
                    <th>Дата окончания</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $index => $order)
                    <tr>
                        <th>{{ $index + 1 }}</th>
                        <td><a class="text-green" href="{{ route('rent-house', $order->house->id) }}">{{ $order->house->title }}</a></td>
                        <td>{{ $order->cost }} руб.</td>
                        <td>{{ $order->status->title }}</td>
                        <td>{{ date('d.m.Y', strtotime($order->date_from)) }}</td>
                        <td>{{ date('d.m.Y', strtotime($order->date_to)) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>У вас не было заказов.</p>
    @endif
@endsection
