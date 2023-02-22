@extends('layouts.app')
@section('title')
<div class="row">
    <div class="col mb-8">
        <h3>
            <i class="bi-pencil"></i>
            {{ __('Edit share') }}
        </h3>
    </div>
    <div class="col mb-4 text-end">
        <a href="{{ route('shares.index') }}" class="btn btn-primary">
            <i class="bi bi-arrow-left"></i> 
            {{ __('Back') }}
        </a>
    </div>
</div>
@endsection
@section('content')
<form action="{{ route('shares.update', $share->id) }}" method="POST" class="mt-4 p-4">
    @csrf
    @method('PUT')
    <div class="form-group m-3">
        <label for="todo_id">{{ __('Task') }}</label>
        <select class="form-select" name="todo_id">
            @foreach($task_data as $task)
                <option value="{{ $task->id }}">{{ $task->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group m-3">
        <label for="user_id">{{ __('User') }}</label>
        <select class="form-select" name="user_id">
            @foreach($user_data as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group m-3">
        <input type="submit" class="btn btn-dark float-end" value="{{ __('Save') }}">
    </div>
</form>
@endsection