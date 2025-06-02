<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
    <!-- Sidebar -->
 
    <div class="sidebar">
        <h3 class="text-center py-3">Admin Panel</h3>
        <ul class="nav flex-column">
            <!-- <li class="nav-item">
                <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.users.index') }}">
                    <i class="fas fa-users"></i> Manage Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.chalets.index') }}">
                    <i class="fas fa-list"></i> Manage Listings
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.bookings.index') }}">
                    <i class="fas fa-calendar-alt"></i> Manage Bookings
                </a>
            </li>
           
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.reviews.index') }}">
                    <i class="fas fa-star"></i> Manage Reviews
                </a>
            </li>
          
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.reports.index') }}">
                    <i class="fas fa-chart-bar"></i> Reports & Analytics
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Admin Dashboard</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-user"></i> Admin
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container-fluid p-4">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



    <!-- SweetAlert2 JS -->
     <!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Show flash messages -->
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: '{{ session('error') }}',
    });
</script>
@endif
</body>
</html>