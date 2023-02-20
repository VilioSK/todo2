@extends('layouts.app')
@section('title')
<div class="row">
    <div class="col mb-8">
        <h3>
            <i class="bi-calendar-event"></i>
            {{ __('Task item detail') }}
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
    <div class="card border-light" >
        <div class="card-body">
        <h5 class="card-title">{{ $todo->name}}</h5>
        <p class="card-text">{{ $todo->description}}</p>
        <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-primary">
            <i class="bi bi-calendar"></i>
            {{ __('Edit') }}
        </a>
        <form action="{{ route('todos.destroy', $todo->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">
                <i class="bi bi-calendar-x"></i>
                {{ __('Delete') }}
            </button>
        </form>
     </div>
</div>    
@endsection