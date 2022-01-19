@extends('admin.index')

@section('admin-content')
    <h2 class="text-green mb-3">Заказы</h2>
    <form action="" method="GET" class="filter-form mb-3">
        <label for="status" class="form-label">Фильтр по статусу: </label>
        <select class="form-select filter-select" name="status" id="status">
            <option value="all" selected>Все</option>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}" @if($status->id == Request::get('status')) selected @endif>{{ $status->title }}</option>
            @endforeach
        </select>
    </form>
    @if (\Illuminate\Support\Facades\Session::has('orderStatusChanged'))
        <div class="alert alert-success mt-3">
            <i class="fas fa-check-circle"></i>
            {{ \Illuminate\Support\Facades\Session::get('orderStatusChanged') }}
        </div>
    @endif
    @if(count($orders) > 0)
        <div class="orders-table-container">
            <table class="table orders-table mt-4">
                <thead>
                <tr class="text-green">
                    <th>ID</th>
                    <th>№ дома</th>
                    <th>Пользователь</th>
                    <th>Стоимость</th>
                    <th>Дата начала</th>
                    <th>Дата окончания</th>
                    <th>Статус</th>
                    <th>Сообщение</th>
                    <th class="text-center">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <th>{{ $order->id }}</th>
                        <td>{{ $order->house->id }}</td>
                        <td>{{ $order->user->full_name }}</td>
                        <td>{{ $order->cost }} руб.</td>
                        <td>{{ date('d.m.Y', strtotime($order->date_from)) }}</td>
                        <td>{{ date('d.m.Y', strtotime($order->date_to)) }}</td>
                        <td>{{ $order->status->title }}</td>
                        <td>{{ $order->comment ?? '' }}</td>
                        <td class="text-center">
                            @if($order->status->title === 'Новый')
                            <a href="{{ route('admin.orders.change-status-order', $order->id) }}" class="btn btn-green">Изменить статус</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <h4 class="text-center">Заказов пока нет.</h4>
    @endif
@endsection
