@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    {{-- Page Heading (like other admin pages) --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Bookings</h1>
        {{-- No "Add New Booking" button here usually, but you can add if needed --}}
        {{-- <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add New Booking
        </a> --}}
    </div>

    {{-- Search and Filter Card --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Bookings</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.bookings.index') }}" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="user_id" class="form-label visually-hidden">Select User</label>
                    <select name="user_id" id="user_id" class="form-select"> {{-- Changed to form-select for Bootstrap 5 --}}
                        <option value="">Select User</option>
                        @foreach($users as $User)
                            <option value="{{ $User->id }}" {{ request('user_id') == $User->id ? 'selected' : '' }}>
                                {{ $User->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="chalet_id" class="form-label visually-hidden">Select Chalet</label>
                    <select name="chalet_id" id="chalet_id" class="form-select"> {{-- Changed to form-select for Bootstrap 5 --}}
                        <option value="">Select Chalet</option>
                        @foreach($chalets as $Chalet)
                            <option value="{{ $Chalet->id }}" {{ request('chalet_id') == $Chalet->id ? 'selected' : '' }}>
                                {{ $Chalet->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search me-1"></i> Search
                    </button>
                </div>
                {{-- Optional: Add a Reset Filters button --}}
                <div class="col-md-2">
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary w-100">
                        <i class="fas fa-sync-alt me-1"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Bookings Table --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Bookings</h6>
        </div>
        <div class="card-body">
            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light"> {{-- Changed to thead-light for a softer look --}}
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Chalet</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Total Price</th>
                            {{-- Add Status/Actions columns if you have them in the controller --}}
                            {{-- <th>Status</th> --}}
                            {{-- <th>Actions</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->user->name ?? 'N/A' }}</td>
                                <td>{{ $booking->chalet->name ?? 'N/A' }}</td>
                                <td>{{ $booking->start ? \Carbon\Carbon::parse($booking->start)->format('M d, Y') : 'N/A' }}</td>
                                <td>{{ $booking->end ? \Carbon\Carbon::parse($booking->end)->format('M d, Y') : 'N/A' }}</td>
                                <td>{{ number_format($booking->total_price, 2) }} JOD</td> {{-- Changed currency to JOD for Jordan --}}
                                {{-- Add Status/Actions data cells --}}
                                {{-- <td>
                                    <span class="badge bg-secondary">{{ ucfirst($booking->status) }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-info btn-sm mb-1"><i class="fas fa-eye me-1"></i> View</a>
                                    <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Are you sure you want to delete this booking?')">
                                            <i class="fas fa-trash me-1"></i> Delete
                                        </button>
                                    </form>
                                </td> --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No bookings found.</td> {{-- Adjusted colspan --}}
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $bookings->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // No specific JS for dynamic behavior needed based on your current request
    // If you plan to implement client-side filtering/sorting with DataTables,
    // you would add the initialization script here after including DataTables libraries.
</script>
@endpush