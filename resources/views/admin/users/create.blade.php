@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            {{ isset($user) ? 'Edit User: ' . $user->name : 'Add New User' }}
        </h1>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Users List
        </a>
    </div>

    {{-- SweetAlert flash messages are handled in layouts/admin.blade.php --}}

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                {{ isset($user) ? 'Update User Details' : 'New User Information' }}
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}" method="POST">
                @csrf
                @if(isset($user))
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                               value="{{ old('name', $user->name ?? '') }}" required
                               @if(isset($user) && $user->role !== 'admin') disabled @endif>
                        @error('name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                               value="{{ old('email', $user->email ?? '') }}" required
                               @if(isset($user) && $user->role !== 'admin') disabled @endif>
                        @error('email')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" id="role" class="form-select" required>
                            <option value="user" {{ (old('role', $user->role ?? '') == 'user') ? 'selected' : '' }}>Renter</option>
                            <option value="owner" {{ (old('role', $user->role ?? '') == 'owner') ? 'selected' : '' }}>Lessor</option>
                            <option value="admin" {{ (old('role', $user->role ?? '') == 'admin') ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('role')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control"
                               placeholder="{{ isset($user) ? 'Leave blank to keep current password' : 'Enter a password' }}"
                               {{ !isset($user) ? 'required' : '' }}>
                        <small class="form-text text-muted">
                            {{ isset($user) ? 'Enter a new password if you want to change it.' : 'Password is required for new users.' }}
                        </small>
                        @error('password')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-save me-2"></i> {{ isset($user) ? 'Update User' : 'Add User' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.getElementById('role');
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');

        // This function will be called on page load and potentially if the role select changes
        function applyFieldDisabling() {
            // Check if we are in 'edit' mode (i.e., $user is defined)
            const isEditing = {{ isset($user) ? 'true' : 'false' }};

            if (isEditing) {
                // In edit mode, check the initial role of the user being edited
                const initialUserRole = "{{ $user->role ?? '' }}"; // Use ?? '' for safety

                // If the user being edited is NOT an admin, disable name/email fields
                if (initialUserRole !== 'admin') {
                    nameInput.disabled = true;
                    emailInput.disabled = true;
                } else {
                    // If the user being edited IS an admin, these fields should be editable
                    nameInput.disabled = false;
                    emailInput.disabled = false;
                }
            } else {
                // In 'create' mode, all fields should be enabled by default
                nameInput.disabled = false;
                emailInput.disabled = false;
            }
        }

        // Apply disabling/enabling when the page loads
        applyFieldDisabling();

        // Optional: If you want to enable/disable fields *dynamically* when the role dropdown is changed
        // in the 'create' mode, or if you want an admin to "promote" a user to admin and then edit their details
        // immediately without a refresh, you can uncomment and adjust this:
        /*
        roleSelect.addEventListener('change', function() {
            if (this.value === 'admin') {
                nameInput.disabled = false;
                emailInput.disabled = false;
            } else if (!{{ isset($user) ? 'true' : 'false' }}) { // Only disable if creating and not admin
                nameInput.disabled = true;
                emailInput.disabled = true;
            } else if ({{ isset($user) ? 'true' : 'false' }} && "{{ $user->role ?? '' }}" !== 'admin') {
                 // In edit mode, if initial user was not admin, keep disabled unless admin is selected
                 nameInput.disabled = this.value !== 'admin';
                 emailInput.disabled = this.value !== 'admin';
            }
        });
        */
        // The simpler PHP-based disabling from before (which checks `$user->role` on page load)
        // is often preferred for clarity, especially if a page refresh happens after role changes.
        // The current JS ensures consistency with that PHP logic for the initial load.
    });
</script>
@endpush