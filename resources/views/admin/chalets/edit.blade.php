@extends('layouts.admin')

@section('content')
    <h1 class="mb-4">Edit Chalet: {{ $chalet->name }}</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Chalet Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.chalets.update', $chalet->id) }}" method="POST" id="updateForm">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Chalet Name *</label>
                    <input type="text" name="name" id="name" 
                           class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', $chalet->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price_per_day">Price Per Day (EGP) *</label>
                    <input type="number" step="0.01" min="0" name="price_per_day" id="price_per_day"
                           class="form-control @error('price_per_day') is-invalid @enderror"
                           value="{{ old('price_per_day', $chalet->price_per_day) }}" required>
                    @error('price_per_day')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Location *</label>
                    <select name="address" id="address" 
                            class="form-control @error('address') is-invalid @enderror" required>
                        <option value="">Select Location</option>
                        @foreach(["Amman", "Zarqa", "Irbid", "Ajloun", "Jerash", "Mafraq", "Balqa", "Madaba", "Karak", "Tafilah", "Maan", "Aqaba"] as $location)
                            <option value="{{ $location }}"
                                {{ old('address', $chalet->address) == $location ? 'selected' : '' }}>
                                {{ $location }}
                            </option>
                        @endforeach
                    </select>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Chalet
                    </button>
                    <a href="{{ route('admin.chalets.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('updateForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        
        Swal.fire({
            title: 'Updating Chalet',
            text: 'Please wait while we save your changes...',
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
                form.submit();
            }
        });
    });
</script>
@endsection