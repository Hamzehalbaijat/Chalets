@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manage Users (Renters & Lessors)</h1>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Add New User
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users List</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.index') }}" method="GET" class="mb-4">
                    <div class="row g-3"> {{-- Use g-3 for consistent gutter --}}
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="Search by name or email"
                                value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="role" class="form-control">
                                <option value="">All Roles</option>
                                <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Renter (user)</option>
                                <option value="owner" {{ request('role') == 'owner' ? 'selected' : '' }}>Lessor (owner)</option>
                                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Filter</button> {{-- Make filter button full width --}}
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                                            <span class="badge bg-info text-dark">User</span> {{-- Changed to Bootstrap info badge --}}
                                        @elseif($user->role == 'owner')
                                            <span class="badge bg-success text-white">Owner</span> {{-- Changed to Bootstrap success badge --}}
                                        @elseif($user->role == 'admin')
                                            <span class="badge bg-primary text-white">Admin</span> {{-- Changed to Bootstrap primary badge --}}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning me-1">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            class="d-inline delete-form"> {{-- Added delete-form class for SweetAlert --}}
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger delete-btn"> {{-- Added delete-btn --}}
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

@push('scripts') {{-- If you have a stack for scripts in your layout --}}
<script>
    // SweetAlert for Delete Confirmation
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default form submission
            const form = this.closest('form');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    popup: 'swal2-modern',
                    title: 'swal2-title-custom',
                    content: 'swal2-content-custom'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit the form if confirmed
                }
            });
        });
    });
</script>
@endpush