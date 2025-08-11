@extends('admin.layouts.app')

@section('title', $user->full_name . ' - Posts')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $user->full_name }} - Posts</h5>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
        </div>
        <div class="card-body">
            @livewire('user-posts', ['user' => $user])
        </div>
    </div>
@endsection
