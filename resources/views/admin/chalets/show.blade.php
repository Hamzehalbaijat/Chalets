@extends('layouts.admin')

@section('content')
    <h3>Chalet Details</h3>
    <div class="row">
        <div class="col-md-6">
            <h4>{{ $chalet->name }}</h4>
            <p><strong>address</strong> {{ $chalet->address }}</p>
            <p><strong>Description:</strong> {{ $chalet->description }}</p>
            <p><strong>Price per Day:</strong> {{ $chalet->price_per_day }} AED</p>
            <p><strong>Status:</strong> {{ $chalet->status }}</p>
            <p><strong>Discount:</strong> {{ $chalet->discount }}%</p>
        </div>
        <div class="col-md-6">
            <h5>Amenities:</h5>
            <ul>
                <li>WiFi: {{ $chalet->wifi ? 'Yes' : 'No' }}</li>
                <li>Pool: {{ $chalet->pool ? 'Yes' : 'No' }}</li>
                <li>Air Conditioners: {{ $chalet->air_conditioners }}</li>
                <li>Parking Spaces: {{ $chalet->parking_spaces }}</li>
                <li>Barbecue: {{ $chalet->barbecue ? 'Yes' : 'No' }}</li>
                <li>View: {{ ucfirst($chalet->view) }}</li>
                <li>Kitchen: {{ $chalet->kitchen ? 'Yes' : 'No' }}</li>
                <li>Kids Play Area: {{ $chalet->kids_play_area ? 'Yes' : 'No' }}</li>
                <li>Pets Allowed: {{ $chalet->pets_allowed ? 'Yes' : 'No' }}</li>
            </ul>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.chalets.index') }}" class="btn btn-secondary">Back to Listings</a>
    </div>
@endsection