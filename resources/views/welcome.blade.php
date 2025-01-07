<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destination Explorer</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom Styles -->
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2ecc71;
            --dark-overlay: rgba(0, 0, 0, 0.6);
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            overflow-x: hidden;
        }

        .navbar-custom {
            background-color: rgba(0, 0, 0, 0.5);
            transition: background-color 0.3s ease;
        }

        .navbar-custom.scrolled {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .navbar-dark .navbar-nav .nav-link {
            color: white;
        }

        .navbar-dark .navbar-nav .nav-link:hover {
            color: var(--primary-color);
        }

        /* Hero Section */
        .hero-container {
            position: relative;
            height: 100vh;
            overflow: hidden;
        }

        .hero-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
            z-index: 1;
        }

        .hero-slide.active {
            opacity: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }

        .hero-title {
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            animation: fadeIn 1.5s ease-in-out;
        }

        .hero-description {
            max-width: 800px;
            margin: 0 auto;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        /* Destination Cards */
        .destination-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .destination-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .destination-card img {
            transition: transform 0.3s ease;
        }

        .destination-card:hover img {
            transform: scale(1.1);
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-description {
                font-size: 1rem;
            }
        }

        .search-container {
            position: relative;
            margin-top: -50px;
            /* Overlap slightly with hero section */
            z-index: 10;
        }

        .search-container .card {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .search-container .form-label {
            color: #333;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .search-container {
                margin-top: -30px;
            }

            .search-container .card {
                margin: 0 15px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-map-marked-alt me-2"></i> Destination Explorer
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">
                            <i class="fas fa-home me-1"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/destinations">
                            <i class="fas fa-map-pin me-1"></i> Destinations
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/categories">
                            <i class="fas fa-tags me-1"></i> Categories
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">
                            <i class="fas fa-info-circle me-1"></i> About
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">
                            <i class="fas fa-envelope me-1"></i> Contact
                        </a>
                    </li>

                    <!-- Authentication Links -->
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown">
                                <i class="fas fa-user me-1"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/dashboard">
                                        <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                                    </a></li>
                                <li><a class="dropdown-item" href="/profile">
                                        <i class="fas fa-user-edit me-1"></i> Profile
                                    </a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-light me-2" href="/login">
                                <i class="fas fa-sign-in-alt me-1"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-light" href="/register">
                                <i class="fas fa-user-plus me-1"></i> Register
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-container position-relative">
        @foreach ($heroes as $hero)
            <div class="hero-slide" data-name="{{ $hero->name }}" data-description="{{ $hero->description }}"
                style="background-image: linear-gradient(var(--dark-overlay), var(--dark-overlay)), url('{{ $hero->image_url }}');">
            </div>
        @endforeach

        <div class="container hero-content">
            <h1 id="hero-title" class="mb-4 display-3 hero-title"></h1>
            <p id="hero-description" class="mb-5 lead hero-description"></p>
            <div>
                <a href="#destinations" class="px-5 py-3 btn btn-primary btn-lg rounded-pill">
                    <i class="fas fa-globe me-2"></i> Start Exploring
                </a>
            </div>
        </div>
    </div>

    <!-- Search Container -->
    <div class="py-4 search-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="border-0 shadow-lg card rounded-3">
                        <div class="p-4 card-body">
                            <form action="{{ route('destinations.search') }}" method="GET">
                                <div class="row g-3 align-items-end">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-tags me-2"></i>Select Category
                                            </label>
                                            <select name="category" class="form-select">
                                                <option value="">All Categories</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-search me-2"></i>Search Destinations
                                            </label>
                                            <input type="text" name="query" class="form-control"
                                                placeholder="Enter destination name or description">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="fas fa-map-marker-alt me-2"></i>Explore
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Destinations Section -->
    <div class="container py-5" id="destinations">
        <h2 class="mb-5 text-center">Our Destinations</h2>
        <div class="row g-4">
            @foreach ($destinations as $destination)
                <div class="mb-4 col-md-4">
                    <div class="border-0 shadow-sm card destination-card">
                        <img src="{{ asset('storage/' . $destination->image) }}" class="card-img-top"
                            alt="{{ $destination->name }}" style="height: 250px; object-fit: cover;" />
                        <div class="card-body">
                            <h2 class="mb-2 h5">
                                {{ $destination->name }}
                                @if ($destination->is_trending)
                                    <span class="badge bg-danger ms-2 small">Trending</span>
                                @endif
                            </h2>

                            <a href="{{ route('destination.show', $destination->id) }}" class="mb-2 text-decoration-none">
                                <span class="badge text-bg-primary">
                                    {{ $destination->category->name }}
                                </span>
                            </a>

                            <div class="mb-2 text-muted small">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                {{ Str::limit($destination->address, 50) }}
                                <a href="#" class="text-primary text-decoration-none">Lihat Map</a>
                            </div>

                            <div class="mb-3 d-flex align-items-center">
                                <div class="text-warning me-2">
                                    @for ($i = 0; $i < 5; $i++)
                                        <i
                                            class="fas fa-star {{ $i < $destination->rating ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                                </div>
                                <span class="text-muted small">
                                    {{ $destination->reviews_count }} Reviews
                                </span>
                            </div>

                            <a href="{{ route('destination.show', $destination->id) }}"
                                class="btn btn-outline-secondary w-100">
                                <i class="fas fa-info-circle me-2"></i>Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $destinations->links() }}
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-4 text-white bg-dark">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Destination Explorer. All rights reserved.</p>
            <div class="mt-3 social-links">
                <a href="#" class="mx-2 text-white"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="mx-2 text-white"><i class="fab fa-twitter"></i></a>
                <a href="#" class="mx-2 text-white"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const $slides = $('.hero-slide');
            const $title = $('#hero-title');
            const $description = $('#hero-description');
            let currentSlide = 0;

            function showSlide(index) {
                $slides.removeClass('active');
                $($slides[index]).addClass('active');
                $title.text($($slides[index]).data('name'));
                $description.text($($slides[index]).data('description') ||
                    'Discover incredible places around the world');
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % $slides.length;
                showSlide(currentSlide);
            }

            showSlide(0);
            setInterval(nextSlide, 5000);

            // Change navbar background on scroll
            $(window).scroll(function() {
                if ($(this).scrollTop() > 50) {
                    $('.navbar-custom').addClass('scrolled');
                } else {
                    $('.navbar-custom').removeClass('scrolled');
                }
            });
        });
    </script>
</body>

</html>
