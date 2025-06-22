@extends('layouts.admin')

@section('content')
<div class="container-fluid"> {{-- Added container-fluid for consistent padding --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Chalets</h1>
       
    </div>

    {{-- Search and Filter Card --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Search & Filter Chalets</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.chalets.index') }}" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="search" class="form-label visually-hidden">Search by name...</label>
                    <input type="text" name="search" id="search" class="form-control" placeholder="Search by name..." value="{{ request('search') }}">
                </div>

                <div class="col-md-3">
                    <label for="max_price" class="form-label visually-hidden">Max Price</label>
                    <input type="number" name="max_price" id="max_price" class="form-control" placeholder="Max Price" value="{{ request('max_price') }}">
                </div>

                <div class="col-md-3">
                    <label for="location" class="form-label visually-hidden">Select Location</label>
                    <select name="location" id="location" class="form-select">
                        <option value="">Select Location</option>
                        {{-- Make sure to set 'selected' based on current request --}}
                        <option value="Amman" {{ request('location') == 'Amman' ? 'selected' : '' }}>Amman</option>
                        <option value="Zarqa" {{ request('location') == 'Zarqa' ? 'selected' : '' }}>Zarqa</option>
                        <option value="Irbid" {{ request('location') == 'Irbid' ? 'selected' : '' }}>Irbid</option>
                        <option value="Ajloun" {{ request('location') == 'Ajloun' ? 'selected' : '' }}>Ajloun</option>
                        <option value="Jerash" {{ request('location') == 'Jerash' ? 'selected' : '' }}>Jerash</option>
                        <option value="Mafraq" {{ request('location') == 'Mafraq' ? 'selected' : '' }}>Mafraq</option>
                        <option value="Balqa" {{ request('location') == 'Balqa' ? 'selected' : '' }}>Balqa</option>
                        <option value="Madaba" {{ request('location') == 'Madaba' ? 'selected' : '' }}>Madaba</option>
                        <option value="Karak" {{ request('location') == 'Karak' ? 'selected' : '' }}>Karak</option>
                        <option value="Tafilah" {{ request('location') == 'Tafilah' ? 'selected' : '' }}>Tafilah</option>
                        <option value="Ma'an" {{ request('location') == 'Ma\'an' ? 'selected' : '' }}>Ma'an</option>
                        <option value="Aqaba" {{ request('location') == 'Aqaba' ? 'selected' : '' }}>Aqaba</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search me-1"></i> Search</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Chalets Table Card --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Chalets</h6>
        </div>
        <div class="card-body">
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
                <table class="table table-bordered table-hover" id="chaletsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Price Per Day</th>
                            <th>Status</th>
                            <th>Owner</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($chalets as $chalet)
                            <tr>
                                <td>{{ $chalet->id }}</td>
                                <td>{{ $chalet->name }}</td>
                                <td>{{ $chalet->address }}</td> {{-- Assuming 'address' is the location --}}
                                <td>{{ number_format($chalet->price_per_day, 2) }} EGP</td>
                                <td>
                                    <span class="badge {{ $chalet->status == 'available' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($chalet->status) }}
                                    </span>
                                </td>
                                <td>{{ $chalet->owner->name ?? 'N/A' }}</td> {{-- Added null coalescing for owner --}}
                                <td>
                                    <a href="{{ route('admin.chalets.edit', $chalet->id) }}" class="btn btn-warning btn-sm mb-1">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.chalets.toggleStatus', $chalet->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-info btn-sm mb-1">
                                            <i class="fas {{ $chalet->status == 'available' ? 'fa-ban' : 'fa-check-circle' }} me-1"></i>
                                            {{ $chalet->status == 'available' ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.chalets.destroy', $chalet->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Are you sure you want to delete this chalet?')">
                                            <i class="fas fa-trash me-1"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No chalets found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $chalets->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
 
</script>
@endpush