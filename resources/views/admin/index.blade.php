@extends('layouts.app')

@section('title', 'Панель администратора')

@section('content')
    <div class="row admin-dashboard">
        <div class="col-lg-3 col-12 admin-sidebar-container">
            <ul class="admin-sidebar">
                <li>
                    <a href="{{ route('admin.index') }}" class="nav-link @if(route('admin.index') === url()->current()) active @endif">
                        Главная
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.categories.categories') }}" class="nav-link @if(route('admin.categories.categories') === url()->current()) active @endif">
                        Категории
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.houses.houses') }}" class="nav-link @if(route('admin.houses.houses') === url()->current()) active @endif">
                        Дома
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.orders.orders') }}" class="nav-link @if(route('admin.orders.orders') === url()->current()) active @endif">
                        Заказы
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-lg-9 col-12">
            @section('admin-content')
                <h2 class="text-green">Панель администратора</h2>
                <p>Добро пожаловать, {{ Illuminate\Support\Facades\Auth::user()->full_name }}!</p>
                <p>Это панель администратора, здесь Вы можете управлять данными.</p>
                <em class="text-green">Сегодня {{ date('d.m.Y') }}</em>
            @endsection
            @yield('admin-content')
        </div>
    </div>
@endsection
