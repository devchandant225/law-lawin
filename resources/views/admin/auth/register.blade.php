<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @section('meta_tags')
        <title>Admin Registration</title>
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
        
        .logo-container {
            width: 6rem;
            height: 6rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: 4px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175);
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
            transform: translateY(-1px) scale(1.02);
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
        
        .text-primary-custom {
            color: var(--primary-color) !important;
        }
        
        .text-secondary-custom {
            color: var(--secondary-color) !important;
        }
        
        .text-primary-custom:hover {
            color: var(--secondary-color) !important;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5 col-xl-4">
                <!-- Header -->
                <div class="text-center mb-4">
                    <!-- Logo Section -->
                    <div class="d-flex justify-content-center mb-4">
                        <div class="logo-container rounded-4 d-flex align-items-center justify-content-center text-white">
                            <i class="bi bi-briefcase" style="font-size: 3rem;"></i>
                        </div>
                    </div>
                    
                    <!-- Company Info -->
                    <div class="mb-4">
                        <h1 class="display-6 fw-bold text-primary-custom mb-2">Lawin & Partners</h1>
                        <p class="fs-6 text-secondary-custom fw-semibold mb-1">Legal Excellence Since 1985</p>
                    </div>
                    
                    <!-- Page Title -->
                    <div>
                        <h2 class="fs-3 fw-bold text-dark mb-2">Admin Account Request</h2>
                        <p class="text-muted small">
                            Request administrative access to the firm's management system
                        </p>
                    </div>
                </div>

                <!-- Registration Form -->
                <form action="{{ route('admin.register.post') }}" method="POST">
                    @csrf
                    <div class="card form-card border-0 rounded-4">
                        <div class="card-body p-4">
                            <!-- Error Messages -->
                            @if ($errors->any())
                                <div class="alert alert-danger d-flex align-items-start mb-4" role="alert">
                                    <i class="bi bi-exclamation-circle-fill me-2 flex-shrink-0"></i>
                                    <div>
                                        <h6 class="alert-heading mb-1">Registration Error</h6>
                                        <ul class="mb-0 small">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <!-- Name Field -->
                            <div class="mb-3">
                                <label for="name" class="form-label fw-medium">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-person text-muted"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control border-start-0 @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           autocomplete="name" 
                                           required
                                           value="{{ old('name') }}"
                                           placeholder="Enter your full legal name">
                                </div>
                            </div>

                            <!-- Email Field -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-medium">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-envelope text-muted"></i>
                                    </span>
                                    <input type="email" 
                                           class="form-control border-start-0 @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           autocomplete="email" 
                                           required
                                           value="{{ old('email') }}"
                                           placeholder="Enter your professional email address">
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
                                           id="password" 
                                           name="password" 
                                           autocomplete="new-password" 
                                           required
                                           placeholder="Create a secure password">
                                </div>
                            </div>

                            <!-- Confirm Password Field -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label fw-medium">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-lock text-muted"></i>
                                    </span>
                                    <input type="password" 
                                           class="form-control border-start-0" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           autocomplete="new-password" 
                                           required
                                           placeholder="Confirm your password">
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="mb-4">
                                <button type="submit" class="btn btn-primary-gradient w-100 py-3 fw-semibold">
                                    <i class="bi bi-plus-lg me-2"></i>
                                    Submit Account Request
                                </button>
                            </div>

                            <!-- Login Link -->
                            <div class="text-center">
                                <p class="small text-muted mb-0">
                                    Already have administrator access?
                                    <a href="{{ route('admin.login') }}" 
                                       class="text-decoration-none fw-semibold text-primary-custom transition-all">
                                        Sign in to Admin Portal
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Back to Website -->
                <div class="text-center mt-4">
                    <a href="{{ url('/') }}" class="text-decoration-none text-muted small hover-scale transition-all">
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