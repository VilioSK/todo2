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
    <div class="card border-light" >
        <div class="card-body">
        <h5 class="card-title">{{ $category->name}}</h5>
        <p class="card-text">{{ $category->description}}</p>
        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-success">
            <i class="bi bi-folder-check"></i>
            {{ __('Edit') }}
        </a>
        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">
                <i class="bi bi-folder-x"></i>
                {{ __('Delete') }}
            </button>
        </form>
     </div>
</div>    
@endsection