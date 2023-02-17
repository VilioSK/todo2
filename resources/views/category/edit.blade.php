@extends('layouts.app')
@section('title')
<div class="row">
    <div class="col mb-8">
        <h3>
            <i class="bi-folder"></i>
            {{ __('Edit category') }}
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
<form action="{{ route('categories.update', $category->id) }}" method="POST" class="mt-4 p-4">
    @csrf
    @method('PUT')
    <div class="form-group m-3">
        <label for="name">{{ __('Name') }}</label>
        <input type="text" class="form-control" value="{{ $category->name }}" name="name">
    </div>
    <div class="form-group m-3">
        <label for="description">{{ __('Description') }}</label>
        <textarea class="form-control" name="description" rows="3"> {{$category->description}} </textarea>
    </div>
    <div class="form-group m-3">
        <input type="submit" class="btn btn-dark float-end" value="{{ __('Save') }}">
    </div>
</form>
@endsection