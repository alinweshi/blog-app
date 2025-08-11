@extends('admin.layouts.app')

@section('title', 'Posts')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Posts</h5>
            <a href="{{ route('posts.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Add Post
            </a>
        </div>
        <div class="card-body">
            @livewire('posts-table') {{-- Only the table + filters is Livewire --}}
        </div>
    </div>
@endsection
