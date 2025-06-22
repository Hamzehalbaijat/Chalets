@extends('layouts.admin')

@section('content')
<div class="container-fluid"> {{-- Use container-fluid for consistent admin panel layout --}}

    {{-- Page Heading --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Reports Overview</h1> {{-- Changed h1 class for consistency --}}
    </div>

    {{-- Alert for any messages (e.g., if data is missing) --}}
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

    <div class="row">
        {{-- Total Users Card --}}
        <div class="col-md-4 mb-4"> {{-- Added mb-4 for margin-bottom --}}
            <div class="card shadow h-100 py-2"> {{-- Added shadow and h-100 for consistent card height --}}
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Users
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers }}</div>
                            <div class="mt-2 text-gray-600">
                                <p class="mb-0">Lessors: {{ $totalLessors }}</p>
                                <p class="mb-0">Renters: {{ $totalRenters }}</p>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Top Booked Chalets Card (Moved to occupy a full row since other cards are gone) --}}
        <div class="col-md-8 mb-4"> {{-- Changed to col-md-8 to span more space --}}
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Top Booked Chalets
                            </div>
                            <div class="mt-2">
                                @forelse ($topChalets as $chalet)
                                    <p class="mb-1 text-gray-800">
                                        <i class="fas fa-home me-1"></i> {{ $chalet->name }} ({{ $chalet->total_bookings }} Bookings)
                                    </p>
                                @empty
                                    <p class="text-gray-600">No top chalets data available.</p>
                                @endforelse
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-trophy fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Total Revenue Card (Now on its own row) --}}
    <div class="row mt-4">
        <div class="col-xl-6 col-md-6 mb-4"> {{-- Adjusted column size for a larger card --}}
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Revenue
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($totalRevenue ?? 0, 2) }} JOD
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Removed the Chalet Status Overview card from here --}}
        {{-- You can add another card here if you have more reports, e.g., Top Users by Bookings --}}
    </div>

</div>
@endsection