@extends('layouts.main')

@section('title', 'Notifications')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">📩 Notifications</h4>

    <div class="card shadow-sm rounded-3">
        <div class="card-body">
            @if($notifications->count() > 0)
                <a href="{{ route('admin.notifications.readAll') }}" class="btn btn-sm btn-outline-success mb-3">
                    Mark All as Read
                </a>

                <ul class="list-group">
                    @foreach($notifications as $notify)
                        <li class="list-group-item d-flex justify-content-between align-items-center {{ $notify->is_read ? '' : 'fw-bold bg-light' }}">
                            <div>
                                <i class="bi bi-bell-fill text-warning me-2"></i>
                                {{ $notify->message }}
                                <br>
                                <small class="text-muted">{{ $notify->created_at->diffForHumans() }}</small>
                            </div>

                            @if(!$notify->is_read)
                                <a href="{{ route('admin.notifications.read', $notify->id) }}" class="btn btn-sm btn-outline-primary">
                                    Mark as Read
                                </a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">No notifications available.</p>
            @endif
        </div>
    </div>
</div>
@endsection
