@extends('layouts.app')
@section('title')
<div class="row">
    <div class="col-8">
        <h3>
            <i class="bi bi-folder-plus"></i>
            {{ __('Add category') }}
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
    <form action="{{ route('categories.store') }}" method="post" class="mt-4 p-4">
    @csrf
        <div class="form-group m-3">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" class="form-control" name="name" placeholder="{{ __('Category name') }}">
        </div>
        <div class="form-group m-3">
            <label for="description">{{ __('Description') }}</label>
            <textarea class="form-control" name="description" rows="3" placeholder="{{ __('Category description') }}"></textarea>
        </div>
        <div class="form-group m-3 float-end">
            <button type="submit" class="btn btn-dark btn-block">{{ __('Create') }}</button>
        </div>
    </form>
@endsection