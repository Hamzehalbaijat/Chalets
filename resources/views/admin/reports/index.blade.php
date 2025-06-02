@extends('layouts.admin')

@section('content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<body>
    <div class="container">
        <h1>Reports</h1>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Total Users</h5>
                    </div>
                    <div class="card-body">
                        <p>Total Users: {{ $totalUsers }}</p>
                        <p>Total Lessors: {{ $totalLessors }}</p>
                        <p>Total Renters: {{ $totalRenters }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Bookings</h5>
                    </div>
                    <div class="card-body">
                        <p>Confirmed Bookings: {{ $confirmedBookings ?? 0 }}</p>
                        <p>Rejected Bookings: {{ $rejectedBookings ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Top Booked Chalets</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($topChalets as $chalet)
                                <li class="list-group-item">
                                    {{ $chalet->name }} - Total Bookings: {{ $chalet->total_bookings }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- Uncomment the below section if you want to display total revenue --}}
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Total Revenue</h5>
                    </div>
                    <div class="card-body">
                        <p>Total Revenue: {{ $totalRevenue ?? 'Not Available' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
@endsection