@include('component.header')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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

/* Discount Badge */
.discount-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background-color: #ff5733; /* Bright red color for the discount */
    color: white;
    font-weight: bold;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 1em;
    z-index: 10;
}

</style>

<h1 class="text-center mt-5" style="font-family: 'Arial', sans-serif; color: #2c3e50;">
    Welcome to Our <span class="text-primary text-uppercase">Chalets</span>
</h1>

<div class="container border py-4">
    <form action="{{ route('showingAllChalets') }}" method="GET">
        <div class="row justify-content-between">
            <div class="col-md-2">
                <input type="text" name="location" class="form-control" placeholder="Enter location" value="{{ old('location') }}">
            </div>
            <div class="col-md-2">
                <input type="number" name="min_price" class="form-control" placeholder="Min Price" value="{{ old('min_price') }}">
            </div>
            <div class="col-md-2">
                <input type="number" name="max_price" class="form-control" placeholder="Max Price" value="{{ old('max_price') }}">
            </div>
            <div class="col-md-2">
                <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}">
            </div>
            <div class="col-md-2">
                <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary px-5">Search</button>
            </div>
        </div>
    </form>
</div>

<div class="container-xxl py-5" id="chalets">
    <div class="container">
        <div class="row g-4">
            @foreach ($chalets as $chalet)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="room-item d-flex flex-column shadow rounded overflow-hidden position-relative {{ $chalet->status == 'not available' ? 'disabled-card' : '' }}">
                        <div class="position-relative">
                            @if($chalet->discount > 0)
                                <div class="discount-badge">Discount</div> <!-- Discount banner -->
                            @endif
                            <img class="img-fluid fixed-img-size" src="{{ asset($chalet->images->first()->image ?? 'img/default.jpg') }}" alt="{{ $chalet->name }}">
                            <small class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">
                                ${{ $chalet->price_per_day }}/Day
                            </small>
                        </div>
                        <div class="p-4 mt-2 card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="mb-0">{{ $chalet->name }}</h5>
                                <div class="ps-2">
                                    {{ number_format($chalet->reviews_avg_rate, 2) }}
                                    @for ($i = 1; $i <= 5; $i++)
                                        <small class="fa fa-star {{ $i <= $chalet->reviews_avg_rate ? 'text-primary' : 'text-muted' }}"></small>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-body mb-3"><strong>Description:</strong> {{ \Illuminate\Support\Str::limit($chalet->description, 80) }}</p>
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
                                    <i class="fa {{ $chalet->pool ? 'fa-swimming-pool' : 'fa-times-circle' }} text-primary me-2"></i>
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
                                    <i class="fa {{ $chalet->pets_allowed ? 'fa-paw' : 'fa-times-circle' }} text-primary me-2"></i>
                                    {{ $chalet->pets_allowed ? 'Yes' : 'No' }}
                                </li>
                            </ul>
                            

                            <div class="d-flex justify-content-between">
                                <a class="btn btn-sm btn-primary rounded py-2 px-4 {{ $chalet->status == 'not available' ? 'disabled' : '' }}" href="{{ route('showChalet', $chalet) }}">
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
        {{ $chalets->links() }}
    </div>
</div>
@include('component.footer')
