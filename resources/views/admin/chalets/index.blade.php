@extends('layouts.admin')

@section('content')
    <h1 class="mb-4">Manage Chalets</h1>

    <div class="card shadow mb-4">
        <div class="container my-3">
            <form method="GET" action="{{ route('admin.chalets.index') }}" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search by name..." value="{{ request('search') }}">
                </div>
                
                <div class="col-md-3">
                    <input type="number" name="max_price" class="form-control" placeholder="Max Price" value="{{ request('max_price') }}">
                </div>

                <div class="col-md-3">
                    <select name="location" class="form-select">
                        <option value="">Select Location</option>
                        <option value="Amman">Amman</option>
                        <option value="Zarqa">Zarqa</option>
                        <option value="Irbid">Irbid</option>
                        <option value="Ajloun">Ajloun</option>
                        <option value="Jerash">Jerash</option>
                        <option value="Mafraq">Mafraq</option>
                        <option value="Balqa">Balqa</option>
                        <option value="Madaba">Madaba</option>
                        <option value="Karak">Karak</option>
                        <option value="Tafilah">Tafilah</option>
                        <option value="Ma'an">Ma'an</option>
                        <option value="Aqaba">Aqaba</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i> Search</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Chalets</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Price Per Day</th>
                            <th>Status</th>
                            <th>Owner</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($chalets as $chalet)
                            <tr>
                                <td>{{ $chalet->id }}</td>
                                <td>{{ $chalet->name }}</td>
                                <td>{{ $chalet->address }}</td>
                                <td>{{ $chalet->price_per_day }} EGP</td>
                                <td>
                                    <span class="badge {{ $chalet->status == 'available' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($chalet->status) }}
                                    </span>
                                </td>
                                <td>{{ $chalet->owner->name }}</td>
                                <td>
                                    <a href="{{ route('admin.chalets.edit', $chalet->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.chalets.toggleStatus', $chalet->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-info btn-sm">
                                            {{ $chalet->status == 'available' ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.chalets.destroy', $chalet->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $chalets->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
    
@endsection