@extends('admin.index')

@section('admin-content')
    <h2 class="text-green mb-3">Категории</h2>
    <a href="{{ route('admin.categories.create-category') }}" class="btn btn-green"><i class="fas fa-plus"></i>&nbsp;Добавить</a>
    @if (\Illuminate\Support\Facades\Session::has('categoryCreated'))
        <div class="alert alert-success mt-3">
            <i class="far fa-check-circle"></i>
            {{ \Illuminate\Support\Facades\Session::get('categoryCreated') }}
        </div>
    @endif
    @if (\Illuminate\Support\Facades\Session::has('categoryUpdated'))
        <div class="alert alert-info mt-3">
            <i class="fas fa-info-circle"></i>
            {{ \Illuminate\Support\Facades\Session::get('categoryUpdated') }}
        </div>
    @endif
    @if (\Illuminate\Support\Facades\Session::has('categoryDeleted'))
        <div class="alert alert-danger mt-3">
            <i class="fas fa-times-circle"></i>
            {{ \Illuminate\Support\Facades\Session::get('categoryDeleted') }}
        </div>
    @endif
    @if(count($categories) > 0)
        <div class="categories-table-container">
            <table class="table categories-table mt-4">
                <thead>
                    <tr class="text-green">
                        <th scope="col">ID</th>
                        <th scope="col">Название</th>
                        <th scope="col">ЧПУ</th>
                        <th class="text-center" scope="col">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <th scope="row">{{ $category->id }}</th>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->slug }}</td>
                        <td class="text-center d-flex justify-content-center">
                            <a href="{{ route('admin.categories.edit-category', $category->slug) }}" class="btn btn-primary mx-1">Изменить</a>
                            <form action="{{ route('admin.categories.delete-category', $category->slug) }}" method="POST" class="mx-1">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger">Удалить</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <h4 class="text-center mt-3">Категорий пока нет.</h4>
    @endif
@endsection
