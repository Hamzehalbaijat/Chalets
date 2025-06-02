@include('component.header')

<?php
// تعريف المتغيرات لاختبار الصفحة بدون الحاجة لجلب البيانات من قاعدة البيانات
$chalet = (object) [
    'name' => 'Luxury Beach Chalet',
    'price' => 150,
    'status' => 'Available',
    'area' => '500', // بالقدم المربع
    'rooms' => '3 Bedrooms, 1 Living Room',
    'bathrooms' => '2',
    'images' => [
        (object) ['url' => 'https://via.placeholder.com/800x400'],
        (object) ['url' => 'https://via.placeholder.com/800x400'],
    ],
    'comments' => [
        (object) [
            'user' => (object) ['name' => 'John Doe'],
            'rating' => 4,
            'content' => 'Amazing place! Highly recommended.',
        ],
        (object) [
            'user' => (object) ['name' => 'Jane Smith'],
            'rating' => 5,
            'content' => 'Had a fantastic experience staying here.',
        ],
    ]
];
?>
<style>
    #BookingForm {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
</style>
<!-- Property Details Page -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Left Side: Property Images & Details -->
            <div class="col-lg-8">
                <div class="row g-4 align-items-center">
                    <!-- Slider for Property Images -->
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div id="propertyCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($chalet->images as $key => $image)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ asset($image->url) }}" class="d-block w-100" alt="Property Image">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#propertyCarousel" role="button" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </a>
                            <a class="carousel-control-next" href="#propertyCarousel" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </a>
                        </div>
                    </div>

                    <!-- Property Details -->
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.3s">
                        <h1 class="mb-4">{{ $chalet->name }}</h1>
                        <p><strong>Price/day: </strong> ${{ $chalet->price }}</p>
                        <p><strong>Status: </strong> Available</p>
                        <p><strong>Address: </strong> {{ $chalet->area }} sq. ft.</p>
                        <p><strong>Description: </strong> {{ $chalet->rooms }} rooms</p>
                        <p><strong>Discount: </strong> {{ $chalet->bathrooms }}%</p>
                    </div>
                </div>
            </div>

            <!-- Right Side: Booking Section -->
            <div class="col-lg-4">
                <div class="bg-white shadow p-4 rounded">
                    <h4 class="mb-3">Book Your Stay</h4>
                    <div class="row g-3">
                        <div class="col-6">
                            <label for="checkin" class="form-label">Check-in</label>
                            <input type="date" class="form-control" id="checkin" name="checkin">
                        </div>
                        <div class="col-6">
                            <label for="checkout" class="form-label">Check-out</label>
                            <input type="date" class="form-control" id="checkout" name="checkout">
                        </div>
                        <div class="col-6">
                            <label for="adults" class="form-label">Adults</label>
                            <select class="form-select" id="adults" name="adults">
                                <option selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="children" class="form-label">Children</label>
                            <select class="form-select" id="children" name="children">
                                <option selected>0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100">Book Now</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Comments Section -->
<div class="container my-5">
    <h2>Comments & Ratings</h2>

    <!-- Comment Form for logged-in users -->
    <form id="commentForm" method="POST">
        @csrf
        <div class="mb-3">
            <label for="content" class="form-label">Your Comment</label>
            <textarea name="content" id="content" class="form-control" rows="3" required></textarea>
        </div>

        <!-- Star Rating -->
        <div class="mb-3">
            <label class="form-label">Rate this Property:</label>
            <div class="rating">
                <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
                <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
                <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                <input type="radio" name="rating" value="1" id="1" required><label for="1">☆</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit Comment</button>
    </form>

    <!-- Display Comments -->
    <div class="comments-list mt-5">
        <h4>All Comments</h4>

        <!-- Container for comments with scroll -->
        <div style="max-height: 300px; overflow-y: auto;">
            @foreach($chalet->comments as $index => $comment)
                <div class="comment-item mb-4" style="{{ $index >= 4 ? 'display: block;' : '' }}">
                    <!-- Display all comments but limit scroll -->
                    <strong>{{ $comment->user->name }}</strong>
                    <div class="rating-display">
                        @for($i = 1; $i <= 5; $i++)
                            <span class="fa fa-star {{ $i <= $comment->rating ? 'checked' : '' }}"></span>
                        @endfor
                    </div>
                    <p>{{ $comment->content }}</p>
                </div>
            @endforeach
        </div>
    </div>




    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    </body>

    </html>