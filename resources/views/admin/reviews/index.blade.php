@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Manage Reviews & Comments</h2>

        <!-- Search & Filter Form -->
        <form method="GET" action="{{ route('admin.reviews.index') }}" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <select name="user_id" class="form-control">
                        <option value="">Select User</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="chalet_id" class="form-control">
                        <option value="">Select Chalet</option>
                        @foreach($chalets as $chalet)
                            <option value="{{ $chalet->id }}" {{ request('chalet_id') == $chalet->id ? 'selected' : '' }}>
                                {{ $chalet->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="rate" class="form-control">
                        <option value="">Select Rating</option>
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ request('rate') == $i ? 'selected' : '' }}>{{ $i }} Stars</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

        <!-- Reviews Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>User</th>
                        <th>Chalet</th>
                        <th>Comment</th>
                        <th>Rating</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $review)
                    <tr>
                        <td>{{ $review->user->name ?? 'Deleted User' }}</td>
                        <td>{{ $review->chalet->name ?? 'Deleted Chalet' }}</td>
                        <td>{{ $review->comment }}</td>
                        <td>
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $review->rate)
                                    <i class="fas fa-star text-warning"></i>
                                @else
                                    <i class="far fa-star text-warning"></i>
                                @endif
                            @endfor
                            ({{ $review->rate }})
                        </td>
                        <td>
                            <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No reviews found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $reviews->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
@endsection