@include('component.header')

<br>

<div class="container">
    <h2>User Profile</h2>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Profile Update Form -->
    @if(isset($user))
        <form action="{{ route('profile_user.update', $user->id) }}" method="POST">
    @else
        <p>No user data available.</p>
    @endif

        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">New Password (Leave blank to keep current)</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>

    <hr>

    <!-------------------------------------------User's bookings -------------------------------------------------------------------------->
    <div class="container">
        <h2>Your Bookings</h2>
    
        @if($bookings->isEmpty())
            <p>No bookings found.</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Chalet</th>
                        <th>Original Price</th>
                        <th>Discount</th>
                        <th>Total Price After Discount</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
    @if($booking->chalet)
        @php
            $originalPrice = $booking->chalet->price_per_day * (new \DateTime($booking->start))->diff(new \DateTime($booking->end))->days;
            $discountAmount = $originalPrice * ($booking->chalet->discount / 100);
            $totalPriceAfterDiscount = $originalPrice - $discountAmount;
        @endphp
        <tr>
            <td>{{ $booking->chalet->name }}</td>
            <td>${{ number_format($originalPrice, 2) }}</td>
            <td>${{ number_format($discountAmount, 2) }} ({{ $booking->chalet->discount }}%)</td>
            <td>${{ number_format($totalPriceAfterDiscount, 2) }}</td>
            <td>{{ $booking->start }}</td>
            <td>{{ $booking->end }}</td>
            <td>
                <form action="{{ route('profile_user.cancelBooking', $booking->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Cancel</button>
                </form>
            </td>
        </tr>
    @else
        <tr>
            <td colspan="7">Chalet information not available</td>
        </tr>
    @endif
@endforeach
                </tbody>
            </table>
        @endif
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