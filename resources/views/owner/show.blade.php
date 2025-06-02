<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Properties - CHALETS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .image-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
            width: 100%;
        }

        .image-grid img {
            max-width: 100%;
            height: auto;
            object-fit: cover;
            max-height: 300px;
        }
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

    <!-- Include Sidebar -->
    @include('owner.sidebar')  <!-- Include Sidebar here -->

    <!-- Main Content -->
    <div class="main-content" id="main-content">

        <h1 class="bold text-dark">Chalet Details - <span class="text-primary">CHALETS</span></h1>

        <div class="form-container mx-auto">
            <h2 class="form-title text-center">Chalet Information</h2>

            <!-- Left side: Basic Information & Features Section -->

            <div class="form-section d-flex justify-content-between">
                <div class="left-side w-50">
                    <!-- Basic Information Section -->
                    <div class="form-section">
                        <h3 class="section-title">Basic Information</h3>
                        <p><strong>Name:</strong> {{ $chalet->name }}</p>
                        <p><strong>Price per Day:</strong> ${{ $chalet->price_per_day }}</p>
                        <p><strong>Address:</strong> {{ $chalet->address }}</p>
                        <p><strong>Discount:</strong> {{ $chalet->discount }}%</p>
                        <p><strong>Description:</strong> {{ $chalet->description }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($chalet->status) }}</p>
                        <p><strong>Area:</strong> {{ $chalet->area }} m²</p>
                        <p><strong>View:</strong> {{ $chalet->view }}</p>
                    </div>

                    <!-- Features Section -->
                    <div class="form-section">
                        <h3 class="section-title">Chalet Features</h3>
                        <p><strong>Bedrooms:</strong> {{ $chalet->bedrooms }}</p>
                        <p><strong>Bathrooms:</strong> {{ $chalet->bathrooms }}</p>
                        <p><strong>Air Conditioners:</strong> {{ $chalet->air_conditioners }}</p>
                        <p><strong>Parking Spaces:</strong> {{ $chalet->parking_spaces }}</p>
                    </div>
                </div>

                <!-- Right side: Image Section -->
                <div class="right-side w-50">
                    <h3 class="section-title">Chalet Image</h3>
                    <div class="d-flex flex-column align-items-center">
                        @if ($chalet->images->isNotEmpty())
                            <img src="{{ asset($chalet->images->first()->image) }}" alt="Chalet Image" class="preview-image mt-3 mb-3" style="max-width: 100%; height: auto; object-fit: cover; max-height: 300px;">
                        @else
                            <p>No image available</p>
                        @endif
                        <div class="image-grid">
                            @foreach($chalet->images->skip(1) as $image)
                                <img src="{{ asset( $image->image) }}" alt="Chalet Image" class="preview-image mt-3 mb-3" style="max-width: 100%; height: auto; object-fit: cover;">
                            @endforeach
                        </div>
                    </div>
                </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

</body>
</html>
