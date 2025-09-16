@extends('layouts.main')

@section('title', 'Profile')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar -->
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <img src="{{ $user->image ? asset('storage/'.$user->image) : 'https://via.placeholder.com/150' }}" 
                         class="rounded-circle mb-3" width="120" height="120" alt="Profile Image">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p class="text-muted">{{ $user->email }}</p>
                    <p><strong>City:</strong> {{ $user->city ?? 'N/A' }}</p>
                    <p><strong>CNIC:</strong> {{ $user->cnic ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Right Content -->
        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="profileTabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" id="info-tab" data-bs-toggle="tab" 
                                    data-bs-target="#info" type="button" role="tab">
                                Profile Info
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="password-tab" data-bs-toggle="tab" 
                                    data-bs-target="#password" type="button" role="tab">
                                Change Password
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content" id="profileTabsContent">
                        <!-- Profile Info -->
                        <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>City</label>
                                    <input type="text" name="city" value="{{ $user->city }}" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>CNIC</label>
                                    <input type="text" name="cnic" value="{{ $user->cnic }}" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Profile Image</label><br>
                                    @if($user->image)
                                        <img src="{{ asset('storage/' . $user->image) }}" alt="Profile" width="100" class="mb-2">
                                    @endif
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-success">Update Profile</button>
                            </form>
                        </div>

                        <!-- Change Password -->
                        <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                            <form action="{{ route('admin.profile.updatePassword') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label>Current Password</label>
                                    <input type="password" name="current_password" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>New Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Confirm New Password</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-warning">Change Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
@endsection
