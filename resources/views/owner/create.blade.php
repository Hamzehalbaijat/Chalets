<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Properties - CHALETS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
   /* Global Styles */
/* Global Styles */
body {
    background-color: #f8f9fa;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.welcome-header {
    margin-bottom: 30px;
    text-align: center;
    padding: 20px 0;
    background-color: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
}

.welcome-header h1 {
    font-size: 32px;
    color: #333;
}

.welcome-header span {
    color: #ff7700; /* Changed to orange */
    font-weight: bold;
}

/* Form Styles */
.form-container {
    background-color: white;
    border-radius: 10px;
    padding: 30px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.form-title {
    font-size: 24px;
    color: #ff7700; /* Changed to orange */
    margin-bottom: 25px;
    border-bottom: 2px solid #ff7700; /* Changed to orange */
    padding-bottom: 10px;
    text-align: center;
    font-weight: 600;
}

.section-title {
    font-size: 20px;
    color: #444;
    margin: 25px 0 15px;
    padding-bottom: 8px;
    border-bottom: 1px solid #e0e0e0;
}

.form-section {
    margin-bottom: 30px;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.form-section:hover {
    box-shadow: 0 5px 15px rgba(255, 119, 0, 0.1); /* Changed to orange */
}

.form-group {
    margin-bottom: 18px;
}

.form-control {
    border-radius: 6px;
    border: 1px solid #ced4da;
    padding: 10px 15px;
    transition: all 0.3s;
}

.form-control:focus {
    border-color: #ff7700; /* Changed to orange */
    box-shadow: 0 0 0 3px rgba(255, 119, 0, 0.25); /* Changed to orange */
}

label {
    font-weight: 500;
    color: #555;
    margin-bottom: 6px;
    display: block;
}

/* Button Styles */
.submit-btn {
    background-color: #ff7700; /* Changed to orange */
    color: white;
    border: none;
    padding: 12px 30px;
    font-size: 16px;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.submit-btn:hover {
    background-color: #e56b00; /* Darker orange */
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 119, 0, 0.3); /* Changed to orange */
}

.submit-btn:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(255, 119, 0, 0.5); /* Changed to orange */
}

/* Image Upload Styles */
.image-upload-container {
    border: 2px dashed #ff7700; /* Changed to orange */
    background-color: #fff9f5; /* Light orange background */
    padding: 35px;
    text-align: center;
    border-radius: 8px;
    transition: all 0.3s ease;
    cursor: pointer;
}

.image-upload-container:hover {
    background-color: #ffeee0; /* Lighter orange */
    border-color: #e56b00; /* Darker orange */
}

.image-upload-container label {
    display: inline-block;
    color: #ff7700; /* Changed to orange */
    font-size: 18px;
    cursor: pointer;
    font-weight: bold;
}

.image-upload-container p {
    margin-top: 10px;
    color: #555;
}

.image-upload-container .bi-cloud-arrow-up {
    font-size: 48px;
    color: #ff7700; /* Changed to orange */
    margin-bottom: 15px;
}

.image-upload-container p.text-muted {
    font-size: 14px;
    margin-top: 5px;
}

.preview-image {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid #ddd;
    transition: all 0.3s ease;
}

.preview-image:hover {
    transform: scale(1.05);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .form-section {
        padding: 15px;
    }
    
    .preview-image {
        height: 150px;
    }
}

/* Alert Styling */
.alert-danger {
    border-left: 4px solid #dc3545;
}

/* Feature Icons */
.feature-icon {
    margin-right: 8px;
    color: #ff7700; /* Changed to orange */
}

/* Sidebar Styles */
#sidebar {
    min-width: 250px;
    max-width: 250px;
    background: #333333;
    color: #fff;
    transition: all 0.3s;
    position: fixed;
    height: 100vh;
    z-index: 999;
    left: 0;
}

#sidebar.active {
    margin-left: -250px;
}

.main-content {
    width: 80%;
    transition: all 0.3s;
    margin-right: -200px !important;
}

/* Sidebar Links */
#sidebar a {
    color: #fff;
    transition: all 0.3s;
    padding: 10px 15px;
    text-decoration: none;
    display: block;
}

#sidebar a:hover {
    background-color: #ff7700; /* Changed to orange */
    color: white;
}

/* Active State for Sidebar */
#sidebar a.active {
    background-color: #ff7700; /* Changed to orange */
    color: white;
    border-left: 4px solid #e56b00; /* Darker orange */
}
    </style>
</head>
<body>

    <div class="container mt-4 mb-5">
        <div class="welcome-header">
            <h1>Welcome to Our <span>CHALETS</span></h1>
        </div>

        <!-- Include Sidebar -->
        @include('owner.sidebar')

        <!-- Main Content -->
        <div class="main-content" id="main-content">
            <div class="container">
                <div class="form-container">
                    <h2 class="form-title">Add New Chalet</h2>

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

                    <form action="{{ route('Owner.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Basic Information Section -->
                        <div class="form-section">
                            <h3 class="section-title"><i class="fas fa-info-circle feature-icon"></i>Basic Information</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Chalet Name:</label>
                                        <input type="text" name="name" id="name" class="form-control" required placeholder="Enter chalet name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price_per_day">Price per Day ($):</label>
                                        <input type="number" name="price_per_day" id="price_per_day" class="form-control" required placeholder="Enter daily price">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Address:</label>
                                        <input type="text" name="address" id="address" class="form-control" required placeholder="Enter full address">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="discount">Discount (%):</label>
                                        <input type="number" name="discount" id="discount" class="form-control" step="0.01" min="0" max="100" value="0" placeholder="Enter discount percentage">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description:</label>
                                        <textarea name="description" id="description" class="form-control" rows="4" required placeholder="Describe your chalet here..."></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status:</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option value="available">Available</option>
                                            <option value="not available">Not Available</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="area">Area (m²):</label>
                                        <input type="number" name="area" id="area" class="form-control" min="0" placeholder="Enter chalet area">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Features Section -->
                        <div class="form-section">
                            <h3 class="section-title"><i class="fas fa-list-check feature-icon"></i>Chalet Features</h3>
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bedrooms"><i class="fas fa-bed feature-icon"></i>Bedrooms:</label>
                                        <input type="number" name="bedrooms" id="bedrooms" class="form-control" min="1" required placeholder="No. of bedrooms">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bathrooms"><i class="fas fa-bath feature-icon"></i>Bathrooms:</label>
                                        <input type="number" name="bathrooms" id="bathrooms" class="form-control" min="1" required placeholder="No. of bathrooms">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="air_conditioners"><i class="fas fa-wind feature-icon"></i>Air Conditioners:</label>
                                        <input type="number" name="air_conditioners" id="air_conditioners" class="form-control" min="0" value="0" placeholder="No. of AC units">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="parking_spaces"><i class="fas fa-car feature-icon"></i>Parking Spaces:</label>
                                        <input type="number" name="parking_spaces" id="parking_spaces" class="form-control" min="0" value="0" placeholder="No. of spaces">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="wifi"><i class="fas fa-wifi feature-icon"></i>WiFi:</label>
                                        <select name="wifi" id="wifi" class="form-control">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pool"><i class="fas fa-swimming-pool feature-icon"></i>Swimming Pool:</label>
                                        <select name="pool" id="pool" class="form-control">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="barbecue"><i class="fas fa-fire feature-icon"></i>Barbecue Area:</label>
                                        <select name="barbecue" id="barbecue" class="form-control">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="kitchen"><i class="fas fa-utensils feature-icon"></i>Kitchen:</label>
                                        <select name="kitchen" id="kitchen" class="form-control">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="kids_play_area"><i class="fas fa-child feature-icon"></i>Kids Play Area:</label>
                                        <select name="kids_play_area" id="kids_play_area" class="form-control">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="pets_allowed"><i class="fas fa-paw feature-icon"></i>Pets Allowed:</label>
                                        <select name="pets_allowed" id="pets_allowed" class="form-control">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="view"><i class="fas fa-mountain feature-icon"></i>View:</label>
                                        <select name="view" id="view" class="form-control">
                                            <option value="sea">Sea</option>
                                            <option value="mountain">Mountain</option>
                                            <option value="city">City</option>
                                            <option value="none">None</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Images Section -->
                        <div class="form-section">
                            <h3 class="section-title"><i class="fas fa-images feature-icon"></i>Chalet Images</h3>
                            
                            <div class="form-group">
                                <div class="image-upload-container">
                                    <label for="images">
                                        <div class="mb-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#007bff" class="bi bi-cloud-arrow-up" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M7.646 5.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2z"/>
                                                <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"/>
                                            </svg>
                                        </div>
                                        <p>Drag images here or click to upload</p>
                                        <p class="text-muted">Add multiple photos to showcase your chalet</p>
                                    </label>
                                    <input type="file" name="images[]" id="images" class="form-control-file d-none" multiple required>
                                </div>
                                <div id="image-preview" class="mt-3 row"></div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="submit-btn">
                                <i class="fas fa-plus-circle me-2"></i>Add Chalet
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Preview images before upload
        document.getElementById('images').addEventListener('change', function(event) {
            var preview = document.getElementById('image-preview');
            preview.innerHTML = '';
            
            for (var i = 0; i < event.target.files.length; i++) {
                var file = event.target.files[i];
                if (!file.type.match('image.*')) continue;
                
                var reader = new FileReader();
                reader.onload = (function(theFile) {
                    return function(e) {
                        var col = document.createElement('div');
                        col.className = 'col-md-3 mb-3';
                        
                        var img = document.createElement('img');
                        img.className = 'preview-image img-fluid';
                        img.src = e.target.result;
                        img.title = theFile.name;
                        
                        col.appendChild(img);
                        preview.appendChild(col);
                    };
                })(file);
                
                reader.readAsDataURL(file);
            }
        });

        // Make the entire upload container clickable
        document.querySelector('.image-upload-container').addEventListener('click', function() {
            document.getElementById('images').click();
        });
        
        // Toggle sidebar function
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            sidebar.classList.toggle('active');
            if (sidebar.classList.contains('active')) {
                mainContent.style.marginLeft = '0';
            } else {
                mainContent.style.marginLeft = '250px';
            }
        }
    </script>
</body>
</html>