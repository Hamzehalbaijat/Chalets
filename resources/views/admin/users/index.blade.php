@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manage Users (Renters & Lessors)</h1>
            <a href="{{ route('admin.users.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Add New User
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users List</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.index') }}" method="GET" class="mb-4">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="Search by name or email"
                                value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="role" class="form-control">
                                <option value="">All Roles</option>
                                <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Renter (user)</option>
                                <option value="owner" {{ request('role') == 'owner' ? 'selected' : '' }}>Lessor(owner)
                                </option>
                                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>

                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->role == 'user')
                                            <span class="badge bg-dark text-white">user</span>
                                        @elseif($user->role == 'owner')
                                            <span class="badge bg-dark text-white">owner</span>
                                        @elseif($user->role == 'admin')
                                            <span class="badge bg-dark text-white">Admin</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection