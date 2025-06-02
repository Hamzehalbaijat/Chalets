<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفاصيل المستخدم</title>
    <link rel="stylesheet" href="path/to/your/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">تفاصيل المستخدم</h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $user->name }}</h5>
                <p class="card-text"><strong>البريد الإلكتروني:</strong> {{ $user->email }}</p>
                <p class="card-text"><strong>الدور:</strong> 
                    @if($user->role == 'admin')
                        <span class="badge bg-danger">مدير</span>
                    @elseif($user->role == 'owner')
                        <span class="badge bg-primary">مؤجر (Lessor)</span>
                    @else
                        <span class="badge bg-success">مستأجر (Renter)</span>
                    @endif
                </p>

                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">تعديل</a>
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذا المستخدم؟')">حذف</button>
                </form>
            </div>
        </div>

        {{-- ملف المالك الشخصي (إن وجد) --}}
        @if($user->ownerProfile)
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">ملف المالك الشخصي</h5>
                <p><strong>العنوان:</strong> {{ $user->ownerProfile->address ?? 'غير متوفر' }}</p>
                <p><strong>تاريخ الميلاد:</strong> {{ $user->ownerProfile->birth_of_date ?? 'غير متوفر' }}</p>
            </div>
        </div>
        @endif

        {{-- الشاليهات التي يملكها المستخدم (إن كان مؤجرًا) --}}
        @if($user->role == 'owner' && $user->chalets->count() > 0)
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">الشاليهات المملوكة</h5>
                <ul class="list-group">
                    @foreach($user->chalets as $chalet)
                        <li class="list-group-item">
                            <a href="{{ route('admin.listings.show', $chalet->id) }}">{{ $chalet->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        {{-- الحجوزات التي قام بها المستخدم --}}
        @if($user->bookings->count() > 0)
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">الحجوزات</h5>
                <ul class="list-group">
                    @foreach($user->bookings as $booking)
                        <li class="list-group-item">
                            <strong>الشاليه:</strong> {{ $booking->chalet->name ?? 'غير معروف' }}<br>
                            <strong>التاريخ:</strong> {{ $booking->booking_date }}<br>
                            <strong>الحالة:</strong> {{ $booking->status }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        {{-- التقييمات التي كتبها المستخدم --}}
        @if($user->reviews->count() > 0)
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">التقييمات</h5>
                <ul class="list-group">
                    @foreach($user->reviews as $review)
                        <li class="list-group-item">
                            <strong>الشاليه:</strong> {{ $review->chalet->name ?? 'غير معروف' }}<br>
                            <strong>التقييم:</strong> {{ $review->rating }}/5<br>
                            <strong>التعليق:</strong> {{ $review->comment }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
    </div>

    <script src="path/to/your/js/bootstrap.bundle.min.js"></script>
</body>
</html>
