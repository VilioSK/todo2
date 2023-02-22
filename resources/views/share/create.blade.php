@extends('layouts.app')
@section('title')
<div class="row">
    <div class="col-8">
        <h3>
            <i class="bi bi-plus-lg"></i>
            {{ __('Add share') }}
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
    <form action="{{ route('shares.store') }}" method="post" class="mt-4 p-4">
    @csrf
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
        <div class="form-group m-3 float-end">
            <button type="submit" class="btn btn-dark btn-block">
                {{ __('Share') }}
            </button>
        </div>
    </form>
@endsection