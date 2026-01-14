<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JaansFabrics.com | Luxury Fabrics Collection</title>
    <!-- CSRF Token for Laravel -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        :root {
            --primary-black: #121212;
            --secondary-black: #1e1e1e;
            --primary-gold: radial-gradient(circle at 30% 30%, #f7e486 0%, #e9d275 18%, #E6C35C 35%, #D4AF37 55%, #e7b836 72%, #daac2d 88%, #a58019 100%);
            --primary-gold-solid: #D4AF37;
            --light-gold: #F4E4A6;
            --dark-gold: #8C6F1C;
            --primary-white: #FFFFFF;
            --off-white: #F8F8F8;
            --light-gray: #E5E5E5;
            --text-gray: #888888;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--primary-black);
            background-color: var(--primary-white);
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
        }

        /* Header Styles */
        .navbar {
            background-color: var(--primary-white);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-black) !important;
        }

        .navbar-brand span {
            background: var(--primary-gold);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-link {
            color: var(--primary-black) !important;
            font-weight: 500;
            margin: 0 0.5rem;
            transition: color 0.3s;
            position: relative;
        }

        .nav-link:hover {
            color: var(--primary-black) !important;
        }

        .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background: var(--primary-gold);
            transition: width 0.3s ease;
        }

        .nav-link:hover:after {
            width: 100%;
        }

        /* Product Card */
        .product-card {
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            background-color: var(--primary-white);
            position: relative;
            border: 1px solid var(--light-gray);
        }

        .product-card:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
            border-color: transparent;
        }

        .product-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: var(--primary-gold);
            color: var(--primary-black);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            z-index: 2;
            box-shadow: 0 4px 10px rgba(140, 111, 28, 0.3);
        }

        /* Footer */
        .footer {
            background-color: var(--primary-black);
            color: var(--primary-white);
            padding: 4rem 0 2rem;
            margin-top: 4rem;
            position: relative;
        }

        .footer:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gold);
        }

        .footer-title {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            color: var(--primary-white);
        }

        .footer-title span {
            background: var(--primary-gold);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
            position: relative;
            padding-left: 0;
            transition: padding-left 0.3s ease;
        }

        .footer-links li:hover {
            padding-left: 10px;
        }

        .footer-links li:before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 2px;
            background: var(--primary-gold);
            transition: width 0.3s ease;
        }

        .footer-links li:hover:before {
            width: 6px;
        }

        .footer-links a {
            color: var(--text-gray);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: var(--light-gold);
        }

        .social-icons {
            display: flex;
            margin-top: 1.5rem;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--secondary-black);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            color: var(--primary-white);
            text-decoration: none;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .social-icon:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--primary-gold);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .social-icon:hover {
            transform: translateY(-5px);
        }

        .social-icon:hover:before {
            opacity: 1;
        }

        .social-icon i {
            position: relative;
            z-index: 1;
        }

        .copyright {
            border-top: 1px solid var(--secondary-black);
            padding-top: 2rem;
            margin-top: 3rem;
            text-align: center;
            color: var(--text-gray);
        }

        /* Buttons with Gold Gradient */
        .btn-gold {
            background: var(--primary-gold);
            color: var(--primary-black);
            font-weight: 600;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .btn-gold:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(140, 111, 28, 0.3);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: var(--off-white);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-gold);
            border-radius: 4px;
        }

        /* Add more styles as needed from your template */
    </style>

    @yield('styles')
</head>

<body>
    <!-- Header/Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('assets/images/Jaans_Fabrics_Logo_Print_Ready_page-0002.jpg') }}" alt="Jaans Fabrics Logo" height="50">
                <span>Fabrics</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Collections</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Masterpieces</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Luxury Fabrics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Embroideries</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Fancy Collection</a>
                    </li>
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h4 class="footer-title">Jaans<span>Fabrics</span></h4>
                    <p>Providing premium quality fabrics and embroideries since 2010.</p>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-pinterest-p"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="footer-title">Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Collections</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="footer-title">Categories</h5>
                    <ul class="footer-links">
                        <li><a href="#">Masterpieces</a></li>
                        <li><a href="#">Luxury Fabrics</a></li>
                        <li><a href="#">Embroideries</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h5 class="footer-title">Contact Info</h5>
                    <ul class="footer-links">
                        <li><i class="fas fa-map-marker-alt me-2"></i> Main Street, Lahore, Pakistan</li>
                        <li><i class="fas fa-phone me-2"></i> +92 300 1234567</li>
                        <li><i class="fas fa-envelope me-2"></i> info@jaansfabrics.com</li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; {{ date('Y') }} JaansFabrics.com. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Scripts -->
    @yield('scripts')
</body>

</html>