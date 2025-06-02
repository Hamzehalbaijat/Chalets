<!-- resources/views/yourpage.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Properties - CHALETS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Add your custom styles here */
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand" href="#">CHALETS</a>
        </div>
    </nav>

    @include('owner.sidebar')  <!-- Include Sidebar here -->


    <div class="main-content" id="main-content">
        <div class="welcome-header mt-3 mx-5">
            <h1>Welcome to Your <span>CHALETS</span></h1>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row w-60 mt-5">
            @foreach($chalets as $chalet)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="chalet-card">
                    <div class="position-relative">
                        @if ($chalet->images && $chalet->images->isNotEmpty())
                            <img src="{{ asset($chalet->images->first()->image ?? 'img/default.jpg') }}" alt="{{ $chalet->name }}" class="chalet-image">
                        @else
                            <img src="https://via.placeholder.com/400x220" alt="No Image" class="chalet-image">
                        @endif
                        <div class="price-tag">${{ $chalet->price_per_day }}/day</div>
                        <div class="status-tag {{ $chalet->status == 'available' ? 'status-available' : 'status-not-available' }}">
                            {{ ucfirst($chalet->status) }}
                        </div>
                    </div>
                    <div class="chalet-details">
                        <h5 class="chalet-title">{{ $chalet->name }}</h5>
                        <p class="chalet-description">
                            <strong>Location:</strong> {{ $chalet->address }}
                        </p>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('Owner.show', $chalet->id) }}" class="btn btn-view btn-action">VIEW</a>
                            <a href="{{ route('Owner.edit', $chalet->id) }}" class="btn btn-view btn-action">EDIT</a>
                            <form action="{{ route('Owner.destroy', $chalet->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-action" aria-label="Delete Chalet" style="background-color: orange; border-color: orange; color: white;">
                                  DELETE
                                  </button>

                            </form>
                        </div>
                        <div class="bookings-container">
                            @if ($chalet->bookings->count() > 0)
                                @foreach ($chalet->bookings as $booking)
                                    <div class="booking-item">
                                        <div class="booking-header">
                                            <span class="booking-name">{{ $booking->user->name }}</span>
                                        </div>
                                        <span class="booking-email">{{ $booking->user->email }}</span>
                                        <span class="booking-dates">
                                            {{ $booking->start_date }} → {{ $booking->end_date }}
                                        </span>
                                    </div>
                                @endforeach
                            @else
                                <div class="no-bookings">
                                    No bookings yet.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            sidebar.classList.toggle('active');
            if (sidebar.classList.contains('active')) {
                mainContent.style.marginLeft = '250px';
            } else {
                mainContent.style.marginLeft = '0';
            }
        }
    </script>
</div>
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        sidebar.classList.toggle('active');
        if (sidebar.classList.contains('active')) {
            mainContent.style.marginLeft = '250px';
        } else {
            mainContent.style.marginLeft = '0';
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
