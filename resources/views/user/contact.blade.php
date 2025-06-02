@include('component.header')

<div class="container d-flex justify-content-center mt-5">
    <div class="card shadow-lg p-4" style="max-width: 800px; width: 100%;">
        <div class="card-body">
            <h3 class="card-title text-center mb-3">Contact Us</h3>
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
            <form action="" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Your Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" name="subject" id="subject" class="form-control"
                        value="{{ old('subject') }}">
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">Your Message</label>
                    <textarea name="message" id="message" class="form-control" rows="5" required>{{ old('message') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100">Send Message</button>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>

                            @endforeach
                        </ul>
                    </div>
                @endif
                
            </form>
        </div>
    </div>
</div>


@include('component.footer')
