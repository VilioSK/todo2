@extends('layouts.app')
@section('title')
<div class="row">
    <div class="col mb-8">
        <h3>
            <i class="bi-folder"></i>
            {{ __('Category list') }}
        </h3>
    </div>
    <div class="col mb-4 text-end">
        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
            {{ __('Add category') }}
        </a>
    </div>
</div>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <th>{{ __('Category name') }}</th>
                    <th colspan="2"></th>
                </thead>
                @foreach($category_list as $category)
                    <tr>
                        <td class="col-11">
                            <a href="{{ route('categories.show', $category->id) }}">
                                {{ $category->name }}
                            </a>
                        </td>
                        <td class="col-1">
                            <a class="btn btn-light" href="{{ route('categories.edit', $category->id) }}" data-bs-toggle="tooltip" data-bs-title="Edit category">
                                <i class="bi bi-pencil" style="font-size: 2rem; color: blue;"></i>
                            </a>
                        </td>
                        <td class="col-1">
                            @if($category->default == false)
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-title="Delete category">
                                    <i class="bi-trash" style="font-size: 2rem; color: red;"></i>
                                </button>
                            </form>
                            @endif    
                        </td>
                    </tr>
                @endforeach
            </ul>
        </div>
    </div>
@endsection