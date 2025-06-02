@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Bookings</h1>
    </div>

    <!-- Search Form -->
    <form method="GET" action="{{ route('admin.bookings.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-3">      
                <select name="user_id" class="form-control">
                    <option value="">Select User</option>
                    @foreach($users as $User)
                        <option value="{{ $User->id }}" {{ request('user_id') == $User->id ? 'selected' : '' }}>
                            {{ $User->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="chalet_id" class="form-control">
                    <option value="">Select Chalet</option>
                    @foreach($chalets as $Chalet)
                        <option value="{{ $Chalet->id }}" {{ request('chalet_id') == $Chalet->id ? 'selected' : '' }}>
                            {{ $Chalet->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </div>
    </form>

    <!-- Bookings Table -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Chalet</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Total Price</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>{{ $booking->user->name ?? 'N/A' }}</td>
                            <td>{{ $booking->chalet->name ?? 'N/A' }}</td>
                            <td>{{ $booking->start ? $booking->start->format('M d, Y') : 'N/A' }}</td>
<td>{{ $booking->end ? $booking->end->format('M d, Y') : 'N/A' }}</td>
                            <td>${{ number_format($booking->total_price, 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">No bookings found</td>
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