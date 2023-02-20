@extends('layouts.app')
@section('title')
<div class="row">
    <div class="col mb-8">
        <h3>
            <i class="bi-list-check"></i>
            {{ __('Task list') }}
        </h3>
    </div>
    <div class="col mb-4 text-end">
        <a href="{{ route('todos.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> 
            {{ __('Add task') }}
        </a>
    </div>
</div>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            @foreach($todo_data as $todo_name => $todo_list)
                @if(count($todo_list))
                    @if($todo_name == 'active')
                        <h4>{{ __('Active tasks') }}</h4>
                    @elseif($todo_name == 'finished')
                        <h4>{{ __('Finished tasks') }}</h4>
                    @elseif($todo_name == 'deleted')
                        <h4>{{ __('Deleted tasks') }}</h4>
                    @endif
                    <table class="table table-hover align-middle" style="margin-bottom: 50px;">
                        <thead class="table-light">
                            <th>{{ __('Task') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th colspan="3"></th>
                        </thead>
                        @foreach($todo_list as $todo)
                            <tr>
                                <td class="col-5">
                                    @if($todo_name != 'deleted')
                                        <a href="{{ route('todos.show', $todo->id) }}">
                                            {{ $todo->name }}
                                        </a>
                                    @else
                                        {{ $todo->name }}
                                    @endif
                                </td>
                                <td class="col-4">                          
                                    {{ $todo->category->name }}
                                </td>
                                <td class="col-1">
                                    @if($todo_name == 'active')
                                        <a class="btn btn-light" href="{{ route('todos.edit', $todo->id) }}" data-bs-toggle="tooltip" data-bs-title="Edit task">
                                            <i class="bi bi-pencil" style="font-size: 2rem; color: blue;"></i>
                                        </a>
                                    @endif
                                </td>
                                <td class="col-1">
                                    @if($todo_name == 'active')
                                        <form action="{{ route('todos.finish', $todo->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-title="Finish task">
                                                <i class="bi-check-lg" style="font-size: 2rem; color: green;"></i>
                                            </button>
                                        </form>                            
                                    @endif
                                </td>
                                <td class="col-1">
                                    @if($todo_name == 'active')
                                    <form action="{{ route('todos.destroy', $todo->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-title="Delete task">
                                            <i class="bi-trash" style="font-size: 2rem; color: red;"></i>
                                        </button>
                                    </form>
                                    @endif
                                    @if($todo_name == 'finished')                                        
                                        <form action="{{ route('todos.activate', $todo->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-title="Set task as active">
                                                <i class="bi-reply" style="font-size: 2rem; color: green;"></i>
                                            </button>
                                        </form>   
                                    @endif
                                    @if($todo_name == 'deleted')
                                        <a class="btn btn-light" href="{{ route('todos.restore', $todo->id) }}" data-bs-toggle="tooltip" data-bs-title="Restore deleted task">
                                            <i class="bi-arrow-counterclockwise" style="font-size: 2rem; color: green;"></i>
                                        </a>
                                    @endif
                                    
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            @endforeach
        </div>
    </div>
@endsection