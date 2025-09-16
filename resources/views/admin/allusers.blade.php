@extends('layouts.main') {{-- aapka admin dashboard master layout --}}

@section('title', 'All Users') {{-- Page title --}}

@section('styles')
<style>

</style>
@endsection


@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Users List</h4>

    <div class="card shadow-sm rounded-3">
        <div class="card-body">
            <table id="mytable" class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Profile</th>
                        <th>Role</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->image)
                                    <img src="{{ asset('storage/'.$user->image) }}" width="40" height="40" class="rounded-circle">
                                @else
                                    <img src="https://api.dicebear.com/6.x/initials/png?seed={{ $user->name }}" width="40" height="40" class="rounded-circle">
                                @endif
                            </td>
                            <td>{{ $user->role ?? 'User' }}</td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            <td>
                               <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                   @csrf
                                   @method('DELETE')
                                   <button type="submit" class="" style="border:none; background-color: transparent; color: red;">Delete</button>
                               </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>

</script>
@endsection

