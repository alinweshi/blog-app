@extends('admin.layouts.app')

@section('title', 'Notifications')

@section('content')
    <div class="card">
        <div class="card-header">Notifications</div>
        <div class="card-body">
            @forelse ($notifications as $notification)
                <div class="mb-2">
                    {{ $notification->data['message'] ?? 'Notification' }}
                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                </div>
            @empty
                <p>No notifications yet.</p>
            @endforelse

            {{ $notifications->links() }}
        </div>
    </div>
@endsection
