@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Booking</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="canceled" {{ $booking->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update Status</button>
            </form>
        </div>
    </div>
</div>
@endsection