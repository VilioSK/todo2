@extends('layouts.app')
@section('title')
<div class="row">
    <div class="col mb-8">
        <h3>
            <i class="bi-folder"></i>
            {{ __('Category detail') }}
        </h3>
    </div>
    <div class="col mb-4 text-end">
        <a href="{{ route('categories.index') }}" class="btn btn-primary">
            <i class="bi bi-arrow-left"></i> 
            {{ __('Back') }}
        </a>
    </div>
</div>
@endsection
@section('content')
<div class="card" >
    <div class="card-body">
        <h5 class="card-title">{{ $category->name}}</h5>
        <p class="card-text">{{ $category->description}}</p>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-2">
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">
                    <i class="bi bi-pencil"></i>
                    {{ __('Edit') }}
                </a>
            </div>
            <div class="col-8">
            </div>
            <div class="col-2 text-end">
                @if($category->default == false)
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">
                        <i class="bi bi-trash"></i>
                        {{ __('Delete') }}
                    </button>
                </form>
                @endif
            </div>
        </div>
    <div>
</div>
@endsection