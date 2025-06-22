<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
    <div class="d-flex" id="wrapper">
        <div class="sidebar" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-bg-gradient text-white">
                <i class="fas fa-cubes me-2"></i> Admin Panel
            </div>
            <div class="list-group list-group-flush">
                <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ Request::routeIs('admin.users.*') ? 'active-sidebar-link' : '' }}">
                    <i class="fas fa-users me-2"></i> Manage Users
                </a>
                <a href="{{ route('admin.chalets.index') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ Request::routeIs('admin.chalets.*') ? 'active-sidebar-link' : '' }}">
                    <i class="fas fa-list-alt me-2"></i> Manage Listings
                </a>
                <a href="{{ route('admin.bookings.index') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ Request::routeIs('admin.bookings.*') ? 'active-sidebar-link' : '' }}">
                    <i class="fas fa-calendar-check me-2"></i> Manage Bookings
                </a>
                <a href="{{ route('admin.reviews.index') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ Request::routeIs('admin.reviews.*') ? 'active-sidebar-link' : '' }}">
                    <i class="fas fa-star me-2"></i> Manage Reviews
                </a>
                <a href="{{ route('admin.reports.index') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ Request::routeIs('admin.reports.*') ? 'active-sidebar-link' : '' }}">
                    <i class="fas fa-chart-line me-2"></i> Reports & Analytics
                </a>
            </div>
        </div>
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-outline-secondary toggle-sidebar-btn" id="menu-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <a class="navbar-brand ms-3 d-none d-lg-block" href="#">Admin Dashboard</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-user-circle me-1"></i> Admin
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('register') }}">
                                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="container-fluid p-4 content-area">
                @yield('content')
            </div>
            </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById("menu-toggle").addEventListener("click", function() {
            document.getElementById("wrapper").classList.toggle("toggled");
        });

        // Add active class based on current route
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.list-group-item');
            navLinks.forEach(link => {
                const linkHref = link.getAttribute('href');
                if (linkHref && currentPath.includes(linkHref)) {
                    link.classList.add('active-sidebar-link');
                }
            });
        });

        // SweetAlert2 Flash Messages
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false,
            customClass: {
                popup: 'swal2-modern',
                title: 'swal2-title-custom',
                content: 'swal2-content-custom'
            }
        });
        @endif

        @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
            customClass: {
                popup: 'swal2-modern',
                title: 'swal2-title-custom',
                content: 'swal2-content-custom'
            }
        });
        @endif

        @if(session('info'))
        Swal.fire({
            icon: 'info',
            title: 'Information',
            text: '{{ session('info') }}',
            customClass: {
                popup: 'swal2-modern',
                title: 'swal2-title-custom',
                content: 'swal2-content-custom'
            }
        });
        @endif

        @if(session('warning'))
        Swal.fire({
            icon: 'warning',
            title: 'Warning!',
            text: '{{ session('warning') }}',
            customClass: {
                popup: 'swal2-modern',
                title: 'swal2-title-custom',
                content: 'swal2-content-custom'
            }
        });
        @endif
    </script>
</body>
</html>