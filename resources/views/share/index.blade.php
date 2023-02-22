@extends('layouts.app')
@section('title')
<div class="row">
    <div class="col mb-8">
        <h3>
            <i class="bi-share"></i>
            {{ __('Shared tasks') }}
        </h3>
    </div>
    <div class="col mb-4 text-end">
        <a href="{{ route('shares.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
            {{ __('Share task') }}
        </a>
    </div>
</div>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <th>{{ __('Task name') }}</th>    
                    <th>{{ __('User name') }}</th>
                    <th colspan="3"></th>
                </thead>
                @foreach($share_data as $share)
                    <tr>
                        <td class="col-5">
                            {{ $share->todo->name }}
                        </td>
                        <td class="col-4">
                            {{ $share->user->name }}
                        </td>
                        <td class="col-1">
                            <a class="btn btn-light" href="{{ route('shares.show', $share->id) }}" data-bs-toggle="tooltip" data-bs-title="Show detail">
                                <i class="bi bi-card-text" style="font-size: 2rem; color: grey;"></i>
                            </a>
                        </td>
                        <td class="col-1">
                            <a class="btn btn-light" href="{{ route('shares.edit', $share->id) }}" data-bs-toggle="tooltip" data-bs-title="Edit">
                                <i class="bi bi-pencil" style="font-size: 2rem; color: blue;"></i>
                            </a>
                        </td>
                        <td class="col-1">
                            <form action="{{ route('shares.destroy', $share->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-title="Unshare">
                                    <i class="bi-trash" style="font-size: 2rem; color: red;"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </ul>
        </div>
    </div>
@endsection