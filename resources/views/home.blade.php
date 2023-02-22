@extends('layouts.app')
@section('title')
<div class="row">
    <div class="col">
        <h3>
            <i class="bi bi-palette"></i>
            {{ __('Dashboard') }}
        </h3>
    </div>
</div>    
@endsection
@section('content')
    @auth
    <div class="container">
        <div class="row" style="margin-top: 50px">
            <div class="col mb-6">
                <div class="card border-light">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h4 class="card-title">{{ __('Tasks') }}</h4>
                            </div>
                            <div class="col text-end">
                                <a href="{{ route('todos.index') }}">
                                    <i class="bi bi-list text-primary" style="font-size:1.5rem"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($task_list as $task)
                            <li class="list-group-item">
                                <i class="bi bi-calendar-event text-primary"></i>
                                <a class="link-primary" href="{{ route('todos.show', $task->id) }}">                                
                                    <b>{{ $task->name }}</b>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col mb-6">
                <div class="card border-light">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h4 class="card-title">{{ __('Categories') }}</h4>
                            </div>
                            <div class="col text-end">
                                <a href="{{ route('todos.index') }}">
                                    <i class="bi bi-list text-primary" style="font-size: 1.5rem;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($category_list as $category)
                        <li class="list-group-item">
                            <i class="bi bi-folder text-primary"></i>
                            <a class="link-primary" href="{{ route('categories.show', $category->id) }}">   
                                <b>{{ $category->name }}</b> 
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row" style="margin-top: 50px">
            <div class="col mb-6">
                <div class="card border-light">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h4 class="card-title">{{ __('Shared tasks') }}</h4>
                            </div>
                            <div class="col text-end">
                                <a href="{{ route('todos.index') }}">
                                    <i class="bi bi-list text-primary" style="font-size: 1.5rem;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($share_list as $share)
                        <li class="list-group-item">
                            <i class="bi bi-share text-primary"></i>
                            <a class="link-primary" href="{{ route('shares.show', $share->id) }}">    
                                <b>{{ $share->todo->name }}</b>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col mb-6">
            </div>
        </div>        
    </div>
    @endauth
    @guest
    <div class="container">
        <div class="row text-center" style="margin-top: 50px">
            <div class="col">
                <h3>{{ __('Please login to continue') }}</h3>
            </div>
        </div>
    </div>
    @endguest
@endsection
