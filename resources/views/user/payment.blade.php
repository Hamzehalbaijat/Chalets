@include('component.header') 

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Payment Page</h4>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                        
                    <p><strong>Chalet:</strong> {{ $chalet_id }}</p>
                    <p><strong>Check-in:</strong> {{ $booking_data['start'] }}</p>
                    <p><strong>Check-out:</strong> {{ $booking_data['end'] }}</p>

                    @if($discount > 0)
                        <p><strong>Original Price:</strong> <del>${{ number_format(($total_price / (1 - $discount / 100)), 2) }}</del></p>
                        <p><strong>Discount Applied:</strong> {{ $discount }}%</p>
                    @endif

                    <p><strong>Total Price:</strong> ${{ number_format($total_price, 2) }}</p>

                    <form action="{{ route('confirm.payment') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="card_number" class="form-label">Card Number</label>
                            <input type="text" class="form-control" id="card_number" name="card_number" required placeholder="Enter your card number">
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label for="expiry_date" class="form-label">Expiry Date</label>
                                <input type="month" class="form-control" id="expiry_date" name="expiry_date" required>
                            </div>
                            <div class="col-6">
                                <label for="cvv" class="form-label">CVV</label>
                                <input type="text" class="form-control" id="cvv" name="cvv" required placeholder="123">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success w-100 mt-3">Pay Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('component.footer')
