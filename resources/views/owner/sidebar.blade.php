<!-- resources/views/layouts/sidebar.blade.php -->
<aside class="sidebar" id="sidebar">
    <a href="{{ route('Owner.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
    <a href="{{ route('Owner.index') }}"><i class="fas fa-house-user"></i> My Chalets</a>
    <a href="{{ route('Owner.create') }}"><i class="fas fa-house"></i> Add New chalet</a>
    <a href="{{ route('owner.chats.index') }}"><i class="fas fa-comments"></i> Chat</a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</aside>
<style>
    :root {
        --primary-color: #f7941d;
        --secondary-color: #336699;
        --dark-color: #2c3e50;
        --light-color: #f8f9fa;
        --success-color: #28a745;
        --danger-color: #dc3545;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f5f5f5;
    }

    /* Sidebar Styles */
    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 100;
        padding: 20px 0;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: var(--dark-color);
        width: 250px;
        overflow-y: auto;
        transition: all 0.3s;
    }

    .sidebar a {
        color: white;
        text-decoration: none;
        display: block;
        padding: 10px 15px;
        margin: 5px 0;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .sidebar a:hover {
        background-color: var(--primary-color);
    }

    .sidebar i {
        margin-right: 10px;
    }

    /* Main Content Styles */
    .main-content {
        margin-left: 250px;
        padding: 20px;
        transition: all 0.3s;
    }

    /* Navbar Styles */
    .navbar {
        background-color: var(--primary-color);
        padding: 10px 20px;
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
    }

    .navbar-brand {
        color: white;
        font-size: 20px;
        font-weight: bold;
    }

    .navbar-toggler {
        color: white;
        border: none;
    }

    /* Responsive Sidebar */
    @media (max-width: 768px) {
        .sidebar {
            left: -250px;
        }

        .main-content {
            margin-left: 0;
        }

        .sidebar.active {
            left: 0;
        }
    }

    .chalet-card {
max-width: 300px;
margin: auto;
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
border-radius: 10px;
overflow: hidden;
background: white;
}

.chalet-image {
width: 100%;
height: 180px; /* Adjust the height to make the images smaller */
object-fit: cover;
}

.chalet-details {
padding: 10px;
font-size: 14px;
}

.chalet-title {
font-size: 16px;
}

.btn-action {
font-size: 12px;
padding: 5px 8px;
}









:root {
    --primary-color: #f7941d;
    --secondary-color: #336699;
    --dark-color: #2c3e50;
    --light-color: #f8f9fa;
    --success-color: #28a745;
    --danger-color: #dc3545;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}

h1, h2, h3 {
    color: var(--dark-color);
    font-weight: bold;
}

/* Navbar Styles */
.navbar {
    background-color: var(--primary-color);
    padding: 10px 20px;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
}

.navbar-brand {
    color: white;
    font-size: 20px;
    font-weight: bold;
}

.navbar-toggler {
    color: white;
    border: none;
}

/* Sidebar Styles */
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    width: 250px;
    background-color: var(--dark-color);
    padding: 20px 0;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow-y: auto;
    z-index: 100;
    transition: all 0.3s;
}

.sidebar a {
    color: white;
    text-decoration: none;
    display: block;
    padding: 10px 15px;
    margin: 5px 0;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.sidebar a:hover {
    background-color: var(--primary-color);
}

.sidebar i {
    margin-right: 10px;
}

/* Main Content Styles */
.main-content {
    margin-left: 250px;
    padding: 20px;
    transition: all 0.3s;
    padding-top: 70px; /* To avoid navbar overlap */
}

.welcome-header {
    margin-top: 50px;
}

.form-container {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.form-title {
    text-align: center;
    margin-bottom: 20px;
    font-size: 24px;
}

.form-section {
    margin-bottom: 20px;
}

.section-title {
    font-size: 18px;
    margin-bottom: 10px;
}

.form-group {
    margin-bottom: 15px;
}

input.form-control {
    width: 100%;
    padding: 8px;
    font-size: 14px;
    border-radius: 4px;
}

textarea.form-control {
    width: 100%;
    padding: 8px;
    font-size: 14px;
    border-radius: 4px;
    height: 150px;
}

/* Chalet Card Styles */
.chalet-card {
    max-width: 300px;
    margin: auto;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    overflow: hidden;
    background: white;
}

.chalet-image {
    width: 100%;
    height: 180px;
    object-fit: cover;
}

.chalet-details {
    padding: 10px;
    font-size: 14px;
}

.chalet-title {
    font-size: 16px;
    font-weight: bold;
    color: var(--dark-color);
}

.btn-action {
    font-size: 12px;
    padding: 5px 8px;
    border-radius: 5px;
}

.btn-action.btn-view {
    background-color: var(--primary-color);
    color: white;
    text-decoration: none;
}

.btn-action.btn-danger {
    background-color: var(--danger-color);
    color: white;
}

.bookings-container {
    margin-top: 10px;
}

.booking-item {
    padding: 10px;
    background-color: #f8f9fa;
    border-radius: 5px;
    margin-bottom: 10px;
}

.booking-header {
    font-weight: bold;
    color: var(--dark-color);
}

.booking-email,
.booking-dates {
    font-size: 12px;
}

/* Success/Error Messages */
.alert {
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
    font-size: 14px;
}

.alert-success {
    background-color: var(--success-color);
    color: white;
}

.alert-danger {
    background-color: var(--danger-color);
    color: white;
}

@media (max-width: 768px) {
    .sidebar {
        left: -250px;
    }

    .main-content {
        margin-left: 0;
    }

    .sidebar.active {
        left: 0;
    }

    .chalet-card {
        max-width: 100%;
    }
}
</style>