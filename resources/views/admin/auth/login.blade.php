<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @section('meta_tags')
        <title>Admin Login</title>
    @show

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #6f42c1;
            --secondary-color: #6c757d;
            --accent-color: #e9ecef;
        }

        body {
            background: linear-gradient(135deg, rgba(111, 66, 193, 0.05) 0%, #e9ecef 50%, rgba(108, 117, 125, 0.05) 100%);
            min-height: 100vh;
        }

        .login-container {
            min-height: 100vh;
        }

        .logo-container {
            width: 10rem;
            height: 4rem;
        }

        .logo-fallback {
            background: linear-gradient(135deg, var(--primary-color) 0%, #5936b4 100%);
            width: 2.5rem;
            height: 2.5rem;
        }

        .form-card {
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175);
            border: 1px solid rgba(0, 0, 0, 0.125);
        }

        .btn-primary-gradient {
            background: linear-gradient(90deg, var(--primary-color) 0%, rgba(111, 66, 193, 0.8) 100%);
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(111, 66, 193, 0.3);
            transition: all 0.15s ease-in-out;
        }

        .btn-primary-gradient:hover {
            background: linear-gradient(90deg, rgba(111, 66, 193, 0.9) 0%, rgba(111, 66, 193, 0.7) 100%);
            transform: translateY(-1px);
            box-shadow: 0 0.75rem 1.5rem rgba(111, 66, 193, 0.4);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25);
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }

        .transition-all {
            transition: all 0.15s ease-in-out;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5 col-xl-4">
                <div class="text-center mb-4">
                    <!-- Logo Section -->
                    <div class="d-flex justify-content-center mb-4">
                        <a href="{{ url('/') }}"
                            class="d-flex align-items-center text-decoration-none hover-scale transition-all">
                            <div class="position-relative">
                                @if ($globalProfile && $globalProfile->logo)
                                    <div
                                        class="logo-container rounded-3 d-flex align-items-center justify-content-center">
                                        <img src="{{ asset('storage/' . $globalProfile->logo) }}"
                                            alt="{{ $globalProfile->name ?? 'Organization Logo' }}"
                                            class="h-100 w-100 object-fit-cover">
                                    </div>
                                @else
                                    <div
                                        class="logo-fallback rounded-3 d-flex align-items-center justify-content-center text-white">
                                        <i class="bi bi-journal-text fs-4"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="d-block d-sm-none ms-3">
                                <div class="fw-bold text-dark">
                                    {{ Str::limit($globalProfile->name ?? 'Lawin', 10) }}
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Page Title -->
                    <div>
                        <h2 class="fw-bold text-dark mb-2">Admin Portal</h2>
                        <p class="text-muted small">
                            Sign in to access the administrative dashboard
                        </p>
                    </div>
                </div>

                <!-- Login Form -->
                <form action="{{ route('admin.login.post') }}" method="POST">
                    @csrf
                    <div class="card form-card border-0 rounded-4">
                        <div class="card-body p-4">
                            <!-- Error Messages -->
                            @if ($errors->any())
                                <div class="alert alert-danger d-flex align-items-start" role="alert">
                                    <i class="bi bi-exclamation-circle-fill me-2 flex-shrink-0"></i>
                                    <div>
                                        <h6 class="alert-heading mb-1">Login Error</h6>
                                        <ul class="mb-0 small">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <!-- Email Field -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-medium">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-envelope text-muted"></i>
                                    </span>
                                    <input type="email"
                                        class="form-control border-start-0 @error('email') is-invalid @enderror"
                                        id="email" name="email" autocomplete="email" required
                                        value="{{ old('email') }}" placeholder="Enter your email address">
                                </div>
                            </div>

                            <!-- Password Field -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-medium">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-lock text-muted"></i>
                                    </span>
                                    <input type="password"
                                        class="form-control border-start-0 @error('password') is-invalid @enderror"
                                        id="password" name="password" autocomplete="current-password" required
                                        placeholder="Enter your password">
                                </div>
                            </div>

                            <!-- Remember Me -->
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                    <label class="form-check-label small" for="remember">
                                        Remember me
                                    </label>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="mb-4">
                                <button type="submit" class="btn btn-primary-gradient w-100 py-3 fw-semibold">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>
                                    Access Admin Portal
                                </button>
                            </div>

                            <!-- Register Link -->
                            <div class="text-center">
                                <p class="small text-muted mb-0">
                                    Need administrator access?
                                    <a href="{{ route('admin.register') }}" class="text-decoration-none fw-semibold"
                                        style="color: var(--primary-color);">
                                        Request Account
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Back to Website -->
                <div class="text-center mt-4">
                    <a href="{{ url('/') }}"
                        class="text-decoration-none text-muted small hover-scale transition-all">
                        <i class="bi bi-arrow-left me-1"></i>
                        Back to Lawin & Partners Website
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
