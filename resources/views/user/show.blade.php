@include('component.header')

<style>
  

.reviews-container {
    max-height: 400px; /* تحديد الحد الأقصى للارتفاع */
    overflow-y: auto; /* تمكين التمرير الرأسي في حالة وجود محتوى زائد */
    padding-right: 10px; /* إضافة هامش داخلي لتجنب تداخل المحتوى مع الحافة */
}


    /* General Styling */
    .chalet-gallery {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .large-image img,
    .small-image img {
        width: 100%;
        height: auto;
        border-radius: 8px;
        object-fit: cover;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .large-image img:hover,
    .small-image img:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    /* Large Image Styling */
    .large-image {
        flex: 1 1 100%;
        max-width: 100%;
    }

    .large-image img {
        height: 400px; /* Adjust as needed */
    }

    /* Small Images Styling */
    .small-image {
        flex: 1 1 calc(25% - 10px); /* Four small images per row */
        max-width: calc(25% - 10px);
    }

    .small-image img {
        height: 150px; /* Adjust as needed */
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .small-image {
            flex: 1 1 calc(50% - 10px); /* Two small images per row on smaller screens */
            max-width: calc(50% - 10px);
        }
    }

    @media (max-width: 576px) {
        .small-image {
            flex: 1 1 100%; /* One small image per row on very small screens */
            max-width: 100%;
        }
    }
</style>
<div class="container-fluid py-5">
    <div class="row g-5">
        <!-- Left Side: Property Images & Details -->
        <div class="col-lg-10 offset-lg-1">
            <div class="row g-4 align-items-center">
                <!-- Slider for Property Images -->
                <div class="chalet-gallery">
                    @foreach ($chalet->images as $index => $image)
                        @if ($index == 0)
                            <!-- Large Image -->
                            <div class="large-image">
                                <a href="{{ asset($image->image) }}" data-lightbox="chalet-gallery" data-title="Chalet Image">
                                    <img src="{{ asset($image->image) }}" alt="{{$chalet->name}}" class="img-fluid">
                                </a>
                            </div>
                        @else
                            <!-- Small Images -->
                            <div class="small-image">
                                <a href="{{ asset($image->image) }}" data-lightbox="chalet-gallery" data-title="Chalet Image">
                                    <img src="{{ asset($image->image) }}" alt="{{$chalet->name}}" class="img-fluid">
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
          
        </div>
    </div>
</div>


<!------------------------------------------------ Property Details -------------------------------------------------------------->
<div class="container py-5">
    <div class="row g-5">
        <!-- Left Side: Property Details -->
        <div class="col-lg-6">
            <div class="wow fadeIn mb-2" data-wow-delay="0.3s">
                <h1 class="mb-4" style="font-size: 2.5rem; font-weight: bold; color: #333;">
                    {{ $chalet->name }}
                </h1>
                <p class="mb-3" style="font-size: 1.2rem;">
                    <strong class="text-primary">Price/day:</strong> <span class="text-dark">${{ $chalet->price_per_day }}</span>
                </p>
                <p class="mb-3" style="font-size: 1.2rem;">
                    <strong class="text-primary">Status:</strong> <span class="text-dark">{{ $chalet->status }}</span>
                </p>
                <p class="mb-3" style="font-size: 1.2rem;">
                    <strong class="text-primary">Address:</strong> <span class="text-dark">{{ $chalet->address }}</span>
                </p>
                <p class="mb-3" style="font-size: 1.2rem;">
                    <strong class="text-primary">Description:</strong> <span class="text-dark">{{ $chalet->description }}</span>
                </p>
                <p class="mb-3" style="font-size: 1.2rem;">
                    <strong class="text-primary">Discount:</strong>
                    @if ($chalet->discount)
                        <span class="text-success">{{ $chalet->discount }}%</span>
                    @else
                        <span class="text-muted">None</span>
                    @endif
                </p>
            </div>
        </div>

        <!-- Right Side: Features -->
        <div class="col-lg-6">
            <div class="wow fadeIn mb-2" data-wow-delay="0.3s">
                <h3 class="mb-4" style="font-size: 2rem; font-weight: bold; color: #333; text-align: left;">
                    Features
                </h3>
                <ul class="list-unstyled d-flex flex-wrap justify-content-between mb-3" style="font-size: 1.2rem;">
                    <li class="d-flex flex-column align-items-center mb-4" style="flex: 0 0 23%; text-align: center;">
                        <i class="fa fa-bed text-primary mb-2" style="font-size: 2rem;"></i>
                        <span><strong>Bedrooms</strong></span>
                        <span class="mt-1">{{ $chalet->bedrooms }}</span>
                    </li>
                    <li class="d-flex flex-column align-items-center mb-4" style="flex: 0 0 23%; text-align: center;">
                        <i class="fa fa-bath text-primary mb-2" style="font-size: 2rem;"></i>
                        <span><strong>Bathrooms</strong></span>
                        <span class="mt-1">{{ $chalet->bathrooms }}</span>
                    </li>
                    <li class="d-flex flex-column align-items-center mb-4" style="flex: 0 0 23%; text-align: center;">
                        <i class="fa {{ $chalet->wifi ? 'fa-wifi' : 'fa-times-circle' }} text-primary mb-2" style="font-size: 2rem;"></i>
                        <span><strong>WiFi</strong></span>
                        <span class="mt-1">{{ $chalet->wifi ? 'Yes' : 'No' }}</span>
                    </li>
                    <li class="d-flex flex-column align-items-center mb-4" style="flex: 0 0 23%; text-align: center;">
                        <i class="fa {{ $chalet->pool ? 'fa-swimming-pool' : 'fa-times-circle' }} text-primary mb-2" style="font-size: 2rem;"></i>
                        <span><strong>Pool</strong></span>
                        <span class="mt-1">{{ $chalet->pool ? 'Yes' : 'No' }}</span>
                    </li>
                    <li class="d-flex flex-column align-items-center mb-4" style="flex: 0 0 23%; text-align: center;">
                        <i class="fa fa-car text-primary mb-2" style="font-size: 2rem;"></i>
                        <span><strong>Parking Spaces</strong></span>
                        <span class="mt-1">{{ $chalet->parking_spaces }}</span>
                    </li>
                    <li class="d-flex flex-column align-items-center mb-4" style="flex: 0 0 23%; text-align: center;">
                        <i class="fa fa-eye text-primary mb-2" style="font-size: 2rem;"></i>
                        <span><strong>View</strong></span>
                        <span class="mt-1">{{ ucfirst($chalet->view) }}</span>
                    </li>
                    <li class="d-flex flex-column align-items-center mb-4" style="flex: 0 0 23%; text-align: center;">
                        <i class="fa {{ $chalet->pets_allowed ? 'fa-paw' : 'fa-times-circle' }} text-primary mb-2" style="font-size: 2rem;"></i>
                        <span><strong>Pets Allowed</strong></span>
                        <span class="mt-1">{{ $chalet->pets_allowed ? 'Yes' : 'No' }}</span>
                    </li>
                    <li class="d-flex flex-column align-items-center mb-4" style="flex: 0 0 23%; text-align: center;">
                        <i class="fa {{ $chalet->air_conditioning ? 'fa-snowflake' : 'fa-times-circle' }} text-primary mb-2" style="font-size: 2rem;"></i>
                        <span><strong>Air Conditioning</strong></span>
                        <span class="mt-1">{{ $chalet->air_conditioning ? 'Yes' : 'No' }}</span>
                    </li>
                    <li class="d-flex flex-column align-items-center mb-4" style="flex: 0 0 23%; text-align: center;">
                        <i class="fa {{ $chalet->heating ? 'fa-thermometer-half' : 'fa-times-circle' }} text-primary mb-2" style="font-size: 2rem;"></i>
                        <span><strong>Heating</strong></span>
                        <span class="mt-1">{{ $chalet->heating ? 'Yes' : 'No' }}</span>
                    </li>
                    <li class="d-flex flex-column align-items-center mb-4" style="flex: 0 0 23%; text-align: center;">
                        <i class="fa {{ $chalet->bbq_area ? 'fa-fire' : 'fa-times-circle' }} text-primary mb-2" style="font-size: 2rem;"></i>
                        <span><strong>BBQ Area</strong></span>
                        <span class="mt-1">{{ $chalet->bbq_area ? 'Yes' : 'No' }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container mb-4">
    <div class="row">
        <!-- قسم التعليقات (Reviews) -->
        <div class="col-lg-6">
            <div class="reviews-container">
                <strong class="text-primary">Reviews:</strong>
                @foreach ($chalet->reviews as $review)
                    <div class="mb-3 card p-3 border-0 shadow-sm">
                        <p><i class="bi bi-person-circle"></i> <strong>{{ $review->user->name }}</strong>
                            <br>{{ $review->comment }} <br>
                            Rating: <span class="text-warning">{{ $review->rate }} ★</span>
                            <span class="text-muted float-end">{{ $review->created_at ?
                                $review->created_at->diffForHumans() : 'No creation date' }}</span>
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-lg-5 ms-auto">
            <div class="bg-white shadow p-4 rounded">
                <h4 class="mb-3">Book Your Stay</h4>

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('bookings.store', $chalet->id) }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-6">
                            <label for="checkin" class="form-label">Check-in</label>
                            <input type="text" class="form-control flatpickr-input" id="checkin" name="start" placeholder="YYY/MM/DD">
                        </div>
                        <div class="col-6">
                            <label for="checkout" class="form-label">Check-out</label>
                            <input type="text" class="form-control flatpickr-input" id="checkout" name="end" placeholder="YYY/MM/DD">
                        </div>
                        <div class="col-6">
                            <label for="adults" class="form-label">Adults</label>
                            <select class="form-select" id="adults" name="adults" required>
                                <option value="1" selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="children" class="form-label">Children</label>
                            <select class="form-select" id="children" name="children" required>
                                <option value="0" selected>0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary w-100">Book Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
       


<!---------------------------------------------------- review and rate Form --------------------------------------------------->
<div class="container">
    <div class="row g-5">
        <div class="col-lg-6 me-auto">
            <div class="">
                <h5 class="mb-3">Add Your Review:</h5>
                <form action="{{ route('add.comment') }}" method="POST">
                    @csrf
                    <input type="hidden" name="chalet_id" value="{{ $chalet->id }}">
                    
                    <!-- Comment Field -->
                    <div class="mb-3">
                        <label for="comment" class="form-label">Your Comment</label>
                        <textarea id="comment" name="comment" class="form-control" rows="4" required placeholder="Write your comment here..."></textarea>
                    </div>

                    <!-- Rating Field -->
                    <div class="mb-3">
                        <label for="rate" class="form-label">Rating</label>
                        <div class="stars-container d-flex align-items-center">
                            <div class="stars" id="stars" data-rating="0">
                                <span class="star" data-value="1">★</span>
                                <span class="star" data-value="2">★</span>
                                <span class="star" data-value="3">★</span>
                                <span class="star" data-value="4">★</span>
                                <span class="star" data-value="5">★</span>
                            </div>
                            <span id="selected-rating" class="ms-3">0 ★</span>
                        </div>
                        <input type="hidden" id="rate" name="rate" value="0">
                    </div>

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

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                    <a class="btn btn-secondary" href="{{ route('showingAllChalets') }}">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* General Styles */
    .stars-container {
        font-size: 2rem;
        cursor: pointer;
    }

    .stars {
        display: inline-flex;
        align-items: center;
    }

    .star {
        color: #ccc; /* Default star color (inactive) */
        transition: color 0.3s ease;
    }

    .star.selected,
    .star:hover {
        color: #ffc107; /* Active star color (yellow) */
    }

    #selected-rating {
        font-size: 1.2rem;
        font-weight: bold;
        color: #333;
    }
</style>

{{--------------------------------------------------------------------------------------------------------------------}}
{{------------------------------------------------- for stars rating -------------------------------------------------}}
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const stars = document.querySelectorAll('.stars .star');
        const selectedRatingElement = document.getElementById('selected-rating');
        const starsContainer = document.getElementById('stars');
        const rateField = document.getElementById('rate');

        // Add click event listeners to stars
        stars.forEach(star => {
            star.addEventListener('click', () => {
                const rating = star.getAttribute('data-value');
                starsContainer.setAttribute('data-rating', rating);
                updateStars(rating);
                selectedRatingElement.textContent = `${rating} ★`;
                rateField.value = rating; // Update hidden input field
            });
        });

        // Function to update star selection
        function updateStars(rating) {
            stars.forEach(star => {
                if (star.getAttribute('data-value') <= rating) {
                    star.classList.add('selected');
                } else {
                    star.classList.remove('selected');
                }
            });
        }
    });
</script>

{{---------------------------------------------------- for Calendar -------------------------------------------------}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let bookedDates = @json($bookedDates ?? []);

        flatpickr("#checkin", {
            dateFormat: "Y-m-d",
            minDate: "today",
            disable: bookedDates || [],
        });

        flatpickr("#checkout", {
            dateFormat: "Y-m-d",
            minDate: "today",
            disable: bookedDates || [],
        });

        console.log(bookedDates);
    });
</script>

@include('component.footer')