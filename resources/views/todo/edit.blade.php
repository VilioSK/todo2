@extends('layouts.app')
@section('title')
<div class="row">
    <div class="col mb-8">
        <h3>
            <i class="bi-calendar"></i>
            {{ __('Edit task') }}
        </h3>
    </div>
    <div class="col mb-4 text-end">
        <a href="{{ route('todos.index') }}" class="btn btn-primary">
            <i class="bi bi-arrow-left"></i> 
            {{ __('Back') }}
        </a>
    </div>
</div>
@endsection
@section('content')
<form action="{{ route('todos.update', $todo->id) }}" method="POST" class="mt-4 p-4">
    @csrf
    @method('PUT')
    <div class="form-group m-3">
        <label for="name">{{ __('Name') }}</label>
        <input type="text" class="form-control" value="{{ $todo->name }}" name="name">
    </div>
    <div class="form-group m-3">
        <label for="description">{{ __('Description') }}</label>
        <textarea class="form-control" name="description" rows="3"> {{$todo->description}} </textarea>
    </div>
    <div class="form-group m-3">
        <input type="submit" class="btn btn-dark float-end" value="{{ __('Save') }}">
    </div>
</form>
@endsection