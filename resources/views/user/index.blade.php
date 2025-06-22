@include('component.header')
<style>
    .fixed-img-size {
        width: 100%;
        height: 350px;
    }

    .fixed-height {
        height: 350px;
    }

    .card-fixed-height {
        display: flex;
        flex-direction: column;
    }

    .card-body {
        flex: 1;
        overflow: hidden;
    }

    .disabled-card {
        opacity: 0.6;
        pointer-events: none;
    }

    .disabled {
        pointer-events: none;
        background-color: gray !important;
        border-color: gray !important;
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
        font-weight: bold;
        text-transform: uppercase;
    }


    .chat-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 10;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }
    
    .chat-btn:hover {
        background: white;
        transform: scale(1.1);
    }
    
    .chat-btn i {
        color: #28a745;
        font-size: 18px;
    }
</style>
<!-- Carousel Start -->
<div class="container-fluid p-0 mb-5">
    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="img/14.jpg" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">Luxurious luxury
                        </h6>
                        <h1 class="display-3 text-white mb-4 animated slideInDown">Discover Luxurious chalets</h1>
                        <a href="{{route('showingAllChalets')}}"
                            class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Our chalets</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="img/15.jpg" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">Luxurious luxury
                        </h6>
                        <h1 class="display-3 text-white mb-4 animated slideInDown">Discover Luxurious chalets</h1>
                        <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Our chalets</a>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Carousel End -->


<!-- About Start -->
<div class="container-xxl py-5" id="about">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h6 class="section-title text-start text-primary text-uppercase">About Us</h6>
                <h1 class="mb-4">Welcome to <span class="text-primary text-uppercase"
                        style="color: orange;">Chalets</span></h1>
                <p class="mb-4">We are a platform specializing in the rental of luxurious <span
                        style="color: orange;">chalets</span> that provide an exceptional relaxation experience in
                    breathtaking natural surroundings. We offer a variety of chalets to suit your needs, whether you're
                    looking for a peaceful retreat away from the city's hustle and bustle or the perfect place to
                    celebrate with friends and family. Our goal is to deliver an unforgettable experience with
                    high-quality service and accommodations equipped with the latest comforts.</p>
                <p>We strive to offer the best chalets that meet your expectations and provide comfort and luxury at
                    every moment. Whether you're a renter looking for the perfect getaway or a chalet owner wanting to
                    rent out your property, we are here to provide a seamless and secure experience that meets all your
                    needs.</p>


            </div>
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-6 text-end">
                        <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="img/4.jpg"
                            style="margin-top: 25%;">
                    </div>
                    <div class="col-6 text-start">
                        <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s" src="img/5.jpg">
                    </div>
                    <div class="col-6 text-end">
                        <img class="img-fluid rounded w-50 wow zoomIn" data-wow-delay="0.5s" src="img/8.jpg">
                    </div>
                    <div class="col-6 text-start">
                        <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s" src="img/10.jpg">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


<!-- chalete Start -->
<div class="container-xxl py-5" id="chalets">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title text-center text-primary text-uppercase">Top Three Chalets</h6>
            <h1 class="mb-5">Explore Our <span class="text-primary text-uppercase">Chalets</span></h1>
        </div>


        <div class="row g-4">
            @foreach ($chalets as $chalet)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div
                        class="room-item d-flex flex-column shadow rounded overflow-hidden position-relative {{ $chalet->status == 'not available' ? 'disabled-card' : '' }}">
                        @if ($chalet->status=='available')
                        <a href = "{{ route('chat.start', $chalet) }}" class="chat-btn" title ="Chat with Owner">
                            <i class="fa fa-comments"></i>
                        </a>
                        @endif
                        <div class="position-relative">
                            <img class="img-fluid fixed-img-size"
                                src="{{ asset($chalet->images->first()->image ?? 'img/default.jpg') }}"
                                alt="{{ $chalet->name }}">
                            <small
                                class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">
                                ${{ $chalet->price_per_day }}/Day
                            </small>
                        </div>
                        <div class="p-4 mt-2 card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="mb-0">{{ $chalet->name }}</h5>
                                <div class="ps-2">
                                    {{ number_format($chalet->reviews_avg_rate, 2) }}
                                    @for ($i = 1; $i <= 5; $i++)
                                        <small
                                            class="fa fa-star {{ $i <= $chalet->reviews_avg_rate ? 'text-primary' : 'text-muted' }}"></small>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-body mb-3"><strong>Description:</strong>
                                {{ \Illuminate\Support\Str::limit($chalet->description, 80) }}</p>
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li class="d-flex align-items-center">
                                    <i class="fa fa-bed text-primary me-2"></i>
                                    {{ $chalet->bedrooms }}
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="fa fa-bath text-primary me-2"></i>
                                    {{ $chalet->bathrooms }}
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="fa {{ $chalet->wifi ? 'fa-wifi' : 'fa-times-circle' }} text-primary me-2"></i>
                                    {{ $chalet->wifi ? 'Yes' : 'No' }}
                                </li>
                                <li class="d-flex align-items-center">
                                    <i
                                        class="fa {{ $chalet->pool ? 'fa-swimming-pool' : 'fa-times-circle' }} text-primary me-2"></i>
                                    {{ $chalet->pool ? 'Yes' : 'No' }}
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="fa fa-car text-primary me-2"></i>
                                    {{ $chalet->parking_spaces }}
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="fa fa-eye text-primary me-2"></i>
                                    {{ ucfirst($chalet->view) }}
                                </li>
                                <li class="d-flex align-items-center">
                                    <i
                                        class="fa {{ $chalet->pets_allowed ? 'fa-paw' : 'fa-times-circle' }} text-primary me-2"></i>
                                    {{ $chalet->pets_allowed ? 'Yes' : 'No' }}
                                </li>
                            </ul>


                            <div class="d-flex justify-content-between">
                                <a class="btn btn-sm btn-primary rounded py-2 px-4 {{ $chalet->status == 'not available' ? 'disabled' : '' }}"
                                    href="{{ route('showChalet', $chalet) }}">
                                    View Details & Booking
                                </a>
                               

                            </div>
                        </div>
                        @if ($chalet->status == 'not available')
                            <div class="overlay">
                                <span class="overlay-text">Not Available</span>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{route('showingAllChalets')}}" class="btn btn-sm btn-primary rounded py-2 px-4">See All </a>
        </div>
    </div>
</div>
<!-- chalete end -->

<!-- Service Start -->
<div class="container-xxl py-5" id="Service">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title text-center text-primary text-uppercase">Our Services</h6>
            <h1 class="mb-5">Discover Our <span class="text-primary text-uppercase">Services</span></h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item rounded">
                    <div class="service-icon bg-transparent border rounded p-1">
                        <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                            <i class="fa fa-home fa-2x text-primary"></i>
                        </div>
                    </div>
                    <h5 class="mb-3">Chalet Rentals</h5>
                    <p class="text-body mb-0">Experience the perfect getaway with our luxurious chalets, offering
                        comfort, privacy, and breathtaking views.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                <div class="service-item rounded">
                    <div class="service-icon bg-transparent border rounded p-1">
                        <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                            <i class="fa fa-tree fa-2x text-primary"></i>
                        </div>
                    </div>
                    <h5 class="mb-3">Farmhouse Retreats</h5>
                    <p class="text-body mb-0">Escape the city and enjoy a peaceful stay in our fully equipped
                        farmhouses, perfect for families and groups.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item rounded">
                    <div class="service-icon bg-transparent border rounded p-1">
                        <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                            <i class="fa fa-swimmer fa-2x text-primary"></i>
                        </div>
                    </div>
                    <h5 class="mb-3">Private Pools</h5>
                    <p class="text-body mb-0">Enjoy a refreshing swim in our private pools, offering relaxation and fun
                        for all guests.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                <div class="service-item rounded">
                    <div class="service-icon bg-transparent border rounded p-1">
                        <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                            <i class="fa fa-fire fa-2x text-primary"></i>
                        </div>
                    </div>
                    <h5 class="mb-3">BBQ & Outdoor Dining</h5>
                    <p class="text-body mb-0">Enjoy delicious outdoor dining with our fully equipped BBQ areas, perfect
                        for gatherings.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item rounded">
                    <div class="service-icon bg-transparent border rounded p-1">
                        <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                            <i class="fa fa-users fa-2x text-primary"></i>
                        </div>
                    </div>
                    <h5 class="mb-3">Event Spaces</h5>
                    <p class="text-body mb-0">Host unforgettable events, from birthdays to corporate retreats, in our
                        spacious venues.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                <div class="service-item rounded">
                    <div class="service-icon bg-transparent border rounded p-1">
                        <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                            <i class="fa fa-child fa-2x text-primary"></i>
                        </div>
                    </div>
                    <h5 class="mb-3">Kids & Family Activities</h5>
                    <p class="text-body mb-0">Keep the whole family entertained with playgrounds, sports areas, and
                        fun-filled activities.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service end -->

{{-- discount --}}
<hr>
<div class="container-xxl py-5" id="discounted-chalets">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title text-center text-primary text-uppercase">Special Discounts</h6>
            <h1 class="mb-5">Discover Our <span class="text-primary text-uppercase">Discounted Chalets</span></h1>
        </div>

        <div class="row g-4">
            @foreach ($discountedChalets as $chalet)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div
                        class="room-item d-flex flex-column shadow rounded overflow-hidden position-relative {{ $chalet->status == 'not available' ? 'disabled-card' : '' }}">
                        <div class="position-relative">
                            <img class="img-fluid fixed-img-size"
                                src="{{ asset($chalet->images->first()->image ?? 'img/default.jpg') }}"
                                alt="{{ $chalet->name }}">
                            <small
                                class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">
                                <del class="text-danger">${{ $chalet->price_per_day }}</del>
                                ${{ $chalet->price_per_day - ($chalet->price_per_day * $chalet->discount / 100) }}/Day
                            </small>
                        </div>
                        <div class="p-4 mt-2 card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="mb-0">{{ $chalet->name }}</h5>
                                <div class="ps-2">
                                    {{ number_format($chalet->reviews_avg_rate, 2) }}
                                    @for ($i = 1; $i <= 5; $i++)
                                        <small
                                            class="fa fa-star {{ $i <= $chalet->reviews_avg_rate ? 'text-primary' : 'text-muted' }}"></small>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-body mb-3"><strong>Description:</strong>
                                {{ \Illuminate\Support\Str::limit($chalet->description, 80) }}</p>
                            <p class="text-danger"><strong>Discount:</strong> {{ $chalet->discount }}% OFF</p>
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li class="d-flex align-items-center">
                                    <i class="fa fa-bed text-primary me-2"></i>
                                    {{ $chalet->bedrooms }}
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="fa fa-bath text-primary me-2"></i>
                                    {{ $chalet->bathrooms }}
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="fa {{ $chalet->wifi ? 'fa-wifi' : 'fa-times-circle' }} text-primary me-2"></i>
                                    {{ $chalet->wifi ? 'Yes' : 'No' }}
                                </li>
                                <li class="d-flex align-items-center">
                                    <i
                                        class="fa {{ $chalet->pool ? 'fa-swimming-pool' : 'fa-times-circle' }} text-primary me-2"></i>
                                    {{ $chalet->pool ? 'Yes' : 'No' }}
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="fa fa-car text-primary me-2"></i>
                                    {{ $chalet->parking_spaces }}
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="fa fa-eye text-primary me-2"></i>
                                    {{ ucfirst($chalet->view) }}
                                </li>
                                <li class="d-flex align-items-center">
                                    <i
                                        class="fa {{ $chalet->pets_allowed ? 'fa-paw' : 'fa-times-circle' }} text-primary me-2"></i>
                                    {{ $chalet->pets_allowed ? 'Yes' : 'No' }}
                                </li>
                            </ul>
                            <div class="d-flex justify-content-between">
                                <a class="btn btn-sm btn-primary rounded py-2 px-4 {{ $chalet->status == 'not available' ? 'disabled' : '' }}"
                                    href="{{ route('showChalet', $chalet) }}">
                                    View Details & Booking
                                </a>
                            </div>
                        </div>
                        @if ($chalet->status == 'not available')
                            <div class="overlay">
                                <span class="overlay-text">Not Available</span>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            {{-- <a href="{{ route('showingAllChalets') }}" class="btn btn-sm btn-primary rounded py-2 px-4">See All </a> --}}
        </div>
    </div>
</div>
<hr>
{{-- end discount --}}




@include('component.footer')
<!-- Footer Start -->