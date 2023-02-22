@extends('layouts.app')
@section('title')
<div class="row">
    <div class="col mb-8">
        <h3>
            <i class="bi-card-text"></i>
            {{ __('Shared task detail') }}
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
<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $share->todo->name}}</h5>
        <p class="card-text">{{ $share->todo->description}}</p>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">{{ __('Owner') }}: {{ $share->owner->name }}</li>
        <li class="list-group-item">{{ __('Shared user') }}: {{ $share->user->name }}</li>
    </ul>
    <div class="card-footer">
        <div class="row">
            <div class="col-2">
                <a href="{{ route('shares.edit', $share->id) }}" class="btn btn-primary">
                    <i class="bi bi-pencil"></i>
                    {{ __('Edit') }}
                </a>
            </div>
            <div class="col-8">
            </div>
            <div class="col-2 text-end">
                <form action="{{ route('shares.destroy', $share->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">
                        <i class="bi bi-trash"></i>
                        {{ __('Unshare') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection