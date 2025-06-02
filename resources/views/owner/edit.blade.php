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
        .submit-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
    
        .submit-btn:hover {
            background-color: #0056b3;
        }
    
        .submit-btn:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.5);
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
      
    <div class="container mt-5">
        <div class="welcome-header mt-5">
            <h1>Edit Chalet - <span>CHALETS</span></h1>
        </div>

        <div class="form-container">
        
            <!-- Error Messages -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('Owner.update', $chalet->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
   

                <!-- Basic Information Section -->
                <div class="form-section">
                    <h3 class="section-title">Basic Information</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Chalet Name:</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $chalet->name }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price_per_day">Price per Day ($):</label>
                                <input type="number" name="price_per_day" id="price_per_day" class="form-control" value="{{ $chalet->price_per_day }}" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" name="address" id="address" class="form-control" value="{{ $chalet->address }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="discount">Discount (%):</label>
                                <input type="number" name="discount" id="discount" class="form-control" step="0.01" min="0" max="100" value="{{ $chalet->discount }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea name="description" id="description" class="form-control" rows="4" required>{{ $chalet->description }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="available" {{ $chalet->status == 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="not available" {{ $chalet->status == 'not available' ? 'selected' : '' }}>Not Available</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="area">Area (m²):</label>
                                <input type="number" name="area" id="area" class="form-control" value="{{ $chalet->area }}" min="0">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Features Section -->
                <div class="form-section">
                    <h3 class="section-title">Chalet Features</h3>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="bedrooms">Bedrooms:</label>
                                <input type="number" name="bedrooms" id="bedrooms" class="form-control" value="{{ $chalet->bedrooms }}" min="1" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="bathrooms">Bathrooms:</label>
                                <input type="number" name="bathrooms" id="bathrooms" class="form-control" value="{{ $chalet->bathrooms }}" min="1" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="air_conditioners">Air Conditioners:</label>
                                <input type="number" name="air_conditioners" id="air_conditioners" class="form-control" value="{{ $chalet->air_conditioners }}" min="0">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="parking_spaces">Parking Spaces:</label>
                                <input type="number" name="parking_spaces" id="parking_spaces" class="form-control" value="{{ $chalet->parking_spaces }}" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="amenities">Amenities:</label>
                                <textarea name="amenities" id="amenities" class="form-control" rows="3">{{ $chalet->amenities }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                            <div class="form-group">
                                <label for="view">view</label>
                                <input type="text" name="view" id="view" class="form-control" value="{{ $chalet->view }}" required>
                            </div>
                        </div>

                <!-- Image Upload Section -->
                <div class="form-section">
                    <h3 class="section-title">Chalet Image</h3>
                    <div class="image-upload-container">
                        <label for="image">Upload Image:</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        @if($chalet->image)
                            <img src="{{ asset('storage/' . $chalet->image) }}" alt="Chalet Image" class="preview-image mt-3">
                        @endif
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="submit-btn" style="background-color: orange; border-color: orange; color: white;">Save Changes</button>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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