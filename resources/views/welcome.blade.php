<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JaansFabrics.com | Luxury Fabrics Collection</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
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
        
        h1, h2, h3, h4, h5, h6 {
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
        
        .navbar-toggler {
            border: none;
            color: var(--primary-black);
        }
        
        .navbar-toggler:focus {
            box-shadow: none;
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(18, 18, 18, 0.85), rgba(18, 18, 18, 0.9)), url('https://images.unsplash.com/photo-1523380744952-b7e00e6e2ffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            color: var(--primary-white);
            padding: 8rem 0 6rem;
            position: relative;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }
        
        .hero-subtitle {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            max-width: 600px;
            color: var(--light-gray);
        }
        
        .hero-highlight {
            background: var(--primary-gold);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Category Section */
        .section-title {
            font-size: 2.5rem;
            margin-bottom: 3rem;
            position: relative;
            display: inline-block;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            width: 60%;
            height: 4px;
            background: var(--primary-gold);
            bottom: -10px;
            left: 0;
            border-radius: 2px;
        }
        
        /* Products Header */
        .products-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .filter-toggle-btn {
            background: var(--primary-gold);
            color: var(--primary-black);
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 4px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }
        
        .filter-toggle-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(140, 111, 28, 0.3);
        }
        
        .sort-dropdown .btn {
            background-color: var(--primary-white);
            border: 1px solid var(--light-gray);
            color: var(--primary-black);
            padding: 0.6rem 1.2rem;
            min-width: 180px;
            text-align: left;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .sort-dropdown .btn:hover, .sort-dropdown .btn:focus {
            border-color: var(--primary-gold-solid);
            box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.1);
        }
        
        .sort-dropdown .btn:after {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
        }
        
        /* Offcanvas Styles */
        .offcanvas-filter {
            background-color: var(--off-white);
        }
        
        .offcanvas-filter .offcanvas-header {
            background: var(--primary-gold);
            color: var(--primary-black);
            border-bottom: 1px solid var(--light-gray);
        }
        
        .offcanvas-filter .offcanvas-title {
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .offcanvas-filter .btn-close {
            background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23121212'%3e%3cpath d='M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z'/%3e%3c/svg%3e") center/1em auto no-repeat;
            opacity: 1;
        }
        
        .filter-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            position: relative;
            display: inline-block;
        }
        
        .filter-title:after {
            content: '';
            position: absolute;
            width: 40px;
            height: 3px;
            background: var(--primary-gold);
            bottom: 0;
            left: 0;
            border-radius: 2px;
        }
        
        .form-check-input:checked {
            background-color: var(--primary-gold-solid);
            border-color: var(--primary-gold-solid);
        }
        
        .form-check-input:focus {
            box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25);
        }
        
        .btn-apply-filters {
            background: var(--primary-gold);
            color: var(--primary-black);
            font-weight: 600;
            border: none;
            padding: 0.75rem;
            border-radius: 4px;
            width: 100%;
            transition: all 0.3s ease;
        }
        
        .btn-apply-filters:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(140, 111, 28, 0.3);
        }
        
        /* Category Card */
        .category-card {
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: var(--primary-white);
            border: 1px solid var(--light-gray);
        }
        
        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            border-color: transparent;
        }
        
        .category-card:hover:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gold);
            z-index: 2;
        }
        
        .category-img {
            height: 250px;
            width: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .category-card:hover .category-img {
            transform: scale(1.05);
        }
        
        .category-name {
            font-size: 1.4rem;
            font-weight: 600;
            padding: 1.5rem 1rem 0.5rem;
            margin: 0;
        }
        
        .category-count {
            color: var(--text-gray);
            padding: 0 1rem 1.5rem;
            font-size: 0.9rem;
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
        
        .product-card:hover:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--primary-gold);
            z-index: 2;
        }
        
        .product-image-container {
            position: relative;
            overflow: hidden;
            height: 280px;
        }
        
        .product-front-img, .product-back-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        
        .product-back-img {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            transform: scale(1.1);
        }
        
        .product-image-container:hover .product-front-img {
            opacity: 0;
            transform: scale(1.1);
        }
        
        .product-image-container:hover .product-back-img {
            opacity: 1;
            transform: scale(1);
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
        
        .product-info {
            padding: 1.5rem;
        }
        
        .product-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--primary-black);
        }
        
        .product-price {
            font-size: 1.3rem;
            font-weight: 700;
            background: linear-gradient(to right, #BF953F, #be9343, #B38728, #FBF5B7, #AA771C);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }
        
        .product-colors {
            display: flex;
            margin-bottom: 0.5rem;
        }
        
        .color-dot {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin-right: 8px;
            border: 2px solid var(--light-gray);
            transition: transform 0.3s ease, border-color 0.3s ease;
            cursor: pointer;
        }
        
        .color-dot:hover {
            transform: scale(1.2);
            border-color: var(--primary-gold-solid);
        }
        
        /* Filters */
        .filter-sidebar {
            background-color: var(--off-white);
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid var(--light-gray);
            position: relative;
        }
        
        .filter-sidebar:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gold);
            border-radius: 8px 8px 0 0;
        }
        
        .filter-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            position: relative;
            display: inline-block;
        }
        
        .filter-title:after {
            content: '';
            position: absolute;
            width: 40px;
            height: 3px;
            background: var(--primary-gold);
            bottom: 0;
            left: 0;
            border-radius: 2px;
        }
        
        .form-check-input:checked {
            background-color: var(--primary-gold-solid);
            border-color: var(--primary-gold-solid);
        }
        
        .form-check-input:focus {
            box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25);
        }
        
        .dropdown-filter {
            margin-bottom: 2rem;
        }
        
        .dropdown-filter .btn {
            background-color: var(--primary-white);
            border: 1px solid var(--light-gray);
            color: var(--primary-black);
            width: 100%;
            text-align: left;
            padding: 0.75rem 1rem;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .dropdown-filter .btn:hover, .dropdown-filter .btn:focus {
            border-color: var(--primary-gold-solid);
            box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.1);
        }
        
        .dropdown-filter .btn:after {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
        }
        
        .dropdown-item.active, .dropdown-item:active {
            background: var(--primary-gold);
            color: var(--primary-black);
            font-weight: 600;
        }
        
        /* Chat Widget */
        .chat-widget {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
        }
        
        .chat-button {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--primary-gold);
            color: var(--primary-black);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 5px 20px rgba(140, 111, 28, 0.4);
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .chat-button:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(244, 228, 166, 0.8) 0%, rgba(212, 175, 55, 0.8) 50%, rgba(140, 111, 28, 0.8) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .chat-button:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(140, 111, 28, 0.5);
        }
        
        .chat-button:hover:before {
            opacity: 1;
        }
        
        .chat-button i {
            position: relative;
            z-index: 1;
        }
        
        .chat-options {
            position: absolute;
            bottom: 70px;
            right: 0;
            background-color: var(--primary-white);
            border-radius: 10px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
            padding: 1rem;
            width: 200px;
            display: none;
            border: 1px solid var(--light-gray);
        }
        
        .chat-options.show {
            display: block;
            animation: fadeIn 0.3s ease;
        }
        
        .chat-option {
            display: flex;
            align-items: center;
            padding: 0.8rem;
            border-radius: 5px;
            margin-bottom: 0.5rem;
            transition: background-color 0.2s, transform 0.2s;
            color: var(--primary-black);
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }
        
        .chat-option:before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: var(--primary-gold);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .chat-option:hover {
            background-color: var(--off-white);
            color: var(--primary-black);
            transform: translateX(5px);
        }
        
        .chat-option:hover:before {
            opacity: 1;
        }
        
        .chat-option i {
            margin-right: 10px;
            font-size: 1.2rem;
            width: 20px;
            text-align: center;
        }
        
        /* Image Slider */
        .image-slider {
            margin: 4rem 0;
        }
        
        .slider-item {
            border-radius: 10px;
            overflow: hidden;
            height: 400px;
            position: relative;
        }
        
        .slider-item:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(244, 228, 166, 0.1) 0%, rgba(212, 175, 55, 0.1) 50%, rgba(140, 111, 28, 0.1) 100%);
            z-index: 1;
        }
        
        .slider-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .carousel-control-prev, .carousel-control-next {
            width: 50px;
            height: 50px;
            background: var(--primary-gold);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.8;
            transition: all 0.3s ease;
        }
        
        .carousel-control-prev {
            left: 20px;
        }
        
        .carousel-control-next {
            right: 20px;
        }
        
        .carousel-control-prev:hover, .carousel-control-next:hover {
            opacity: 1;
            transform: translateY(-50%) scale(1.1);
        }
        
        .slider-dots {
            display: flex;
            justify-content: center;
            margin-top: 1.5rem;
        }
        
        .slider-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: var(--light-gray);
            margin: 0 8px;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        
        .slider-dot.active {
            background: var(--primary-gold);
            transform: scale(1.2);
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
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .products-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .sort-dropdown {
                width: 100%;
            }
            
            .sort-dropdown .btn {
                width: 100%;
            }
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
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #8C6F1C 0%, #D4AF37 50%, #F4E4A6 100%);
        }
    </style>
</head>
<body>
    <!-- Header/Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="Jaans_Fabrics_Logo_Print_Ready_page-0002.jpg" alt="" height="50"><span>Fabrics</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
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

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title">LUXURY <span class="hero-highlight">FABRICS</span> & EMBROIDERIES</h1>
                    <p class="hero-subtitle">Discover our exclusive collection of premium fabrics, intricate embroideries, and luxury materials for every season. Crafted with precision for those who appreciate elegance.</p>
                    <a href="#collections" class="btn btn-gold btn-lg">Explore Collections</a>
                </div>
            </div>
        </div>
    </section>
   {{-- <main>
        @yield('content')
    </main> --}}
    <!-- Main Content -->
    <div class="container mt-5">
        <!-- Products Header with Filter Button and Sort Dropdown -->
        <div class="products-header">
            <div>
                <h2 class="section-title" id="collections">Luxury Unstitched Fabric Collection</h2>
            </div>
            <div class="d-flex gap-3 align-items-center">
                <button class="filter-toggle-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#filterOffcanvas" aria-controls="filterOffcanvas">
                    <i class="fas fa-filter"></i> Filters
                </button>
                
                <div class="sort-dropdown">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="productSort" data-bs-toggle="dropdown" aria-expanded="false">
                            Sort by: Best Selling
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="productSort">
                            <li><a class="dropdown-item" href="#" data-sort="best">Best Selling</a></li>
                            <li><a class="dropdown-item" href="#" data-sort="a-z">Alphabetically A-Z</a></li>
                            <li><a class="dropdown-item" href="#" data-sort="z-a">Alphabetically Z-A</a></li>
                            <li><a class="dropdown-item" href="#" data-sort="old">Old to New</a></li>
                            <li><a class="dropdown-item" href="#" data-sort="new">New to Old</a></li>
                            <li><a class="dropdown-item" href="#" data-sort="low">Price Low to High</a></li>
                            <li><a class="dropdown-item" href="#" data-sort="high">Price High to Low</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Products Section (Full Width) -->
        <div class="row" id="productGrid">
            <div class="col-md-6 col-lg-4">
                <div class="product-card">
                    <div class="product-badge gold-shimmer">BEST SELLER</div>
                    <div class="product-image-container">
                        <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" class="product-front-img" alt="Luxury Silk Fabric">
                        <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" class="product-back-img" alt="Luxury Silk Fabric Back">
                    </div>
                    <div class="product-info">
                        <h5 class="product-title">Premium Silk Embroidered</h5>
                        <div class="product-price">PKR 8,500</div>
                        <div class="product-colors">
                            <div class="color-dot" style="background-color: #D4AF37;"></div>
                            <div class="color-dot" style="background-color: #2C3E50;"></div>
                            <div class="color-dot" style="background-color: #7D3C98;"></div>
                            <div class="color-dot" style="background-color: #C0392B;"></div>
                            <span class="text-muted ms-2">+3</span>
                        </div>
                        <div class="text-muted">Embroidered Silk | Winter Collection</div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="product-card">
                    <div class="product-image-container">
                        <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" class="product-front-img" alt="Cotton Linen Fabric">
                        <img src="https://images.unsplash.com/photo-1567401893414-76b7b1e5a7a5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" class="product-back-img" alt="Cotton Linen Fabric Back">
                    </div>
                    <div class="product-info">
                        <h5 class="product-title">Cotton Linen Blend</h5>
                        <div class="product-price">PKR 5,200</div>
                        <div class="product-colors">
                            <div class="color-dot" style="background-color: #ECF0F1;"></div>
                            <div class="color-dot" style="background-color: #34495E;"></div>
                            <div class="color-dot" style="background-color: #1ABC9C;"></div>
                        </div>
                        <div class="text-muted">Premium Cotton | Summer Collection</div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="product-card">
                    <div class="product-badge gold-shimmer">NEW</div>
                    <div class="product-image-container">
                        <img src="https://images.unsplash.com/photo-1562157873-818bc0726f68?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" class="product-front-img" alt="Velvet Fabric">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" class="product-back-img" alt="Velvet Fabric Back">
                    </div>
                    <div class="product-info">
                        <h5 class="product-title">Royal Velvet Collection</h5>
                        <div class="product-price">PKR 12,000</div>
                        <div class="product-colors">
                            <div class="color-dot" style="background-color: #2C3E50;"></div>
                            <div class="color-dot" style="background-color: #7D3C98;"></div>
                            <div class="color-dot" style="background-color: #C0392B;"></div>
                        </div>
                        <div class="text-muted">Luxury Velvet | Winter Collection</div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="product-card">
                    <div class="product-image-container">
                        <img src="https://images.unsplash.com/photo-1520004434532-668416a08753?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" class="product-front-img" alt="Chiffon Fabric">
                        <img src="https://images.unsplash.com/photo-1544441893-675973e31985?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" class="product-back-img" alt="Chiffon Fabric Back">
                    </div>
                    <div class="product-info">
                        <h5 class="product-title">Sheer Chiffon Embroidered</h5>
                        <div class="product-price">PKR 6,800</div>
                        <div class="product-colors">
                            <div class="color-dot" style="background-color: #FADBD8;"></div>
                            <div class="color-dot" style="background-color: #D4EFDF;"></div>
                            <div class="color-dot" style="background-color: #D6EAF8;"></div>
                            <div class="color-dot" style="background-color: #FCF3CF;"></div>
                        </div>
                        <div class="text-muted">Embroidered Chiffon | All Seasons</div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="product-card">
                    <div class="product-badge gold-shimmer">LIMITED</div>
                    <div class="product-image-container">
                        <img src="https://tailorbros.com/wp-content/uploads/2023/10/cotton-fabric-unveiled-best-cotton-types-for-mens-suits-3407-2.jpg" class="product-front-img" alt="Wool Fabric">
                        <img src="https://images.unsplash.com/photo-1519457431-44ccd64a579b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" class="product-back-img" alt="Wool Fabric Back">
                    </div>
                    <div class="product-info">
                        <h5 class="product-title">Pure Wool Premium</h5>
                        <div class="product-price">PKR 9,500</div>
                        <div class="product-colors">
                            <div class="color-dot" style="background-color: #5D6D7E;"></div>
                            <div class="color-dot" style="background-color: #1C2833;"></div>
                            <div class="color-dot" style="background-color: #641E16;"></div>
                        </div>
                        <div class="text-muted">100% Wool | Winter Collection</div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="product-card">
                    <div class="product-image-container">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQZQOTC-NUcdS64ezfaqkPTxI8dbonIIsCV6Q&s" class="product-front-img" alt="Organza Fabric">
                        <img src="https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" class="product-back-img" alt="Organza Fabric Back">
                    </div>
                    <div class="product-info">
                        <h5 class="product-title">Sparkle Organza Collection</h5>
                        <div class="product-price">PKR 7,200</div>
                        <div class="product-colors">
                            <div class="color-dot" style="background-color: #F7DC6F;"></div>
                            <div class="color-dot" style="background-color: #F0B27A;"></div>
                            <div class="color-dot" style="background-color: #D7BDE2;"></div>
                        </div>
                        <div class="text-muted">Embellished Organza | Party Wear</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="container mt-5">
        <h2 class="section-title">Shop by Category</h2>
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" class="category-img" alt="Masterpieces">
                    <h4 class="category-name">Masterpieces</h4>
                    <div class="category-count">45 Products</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1523380744952-b7e00e6e2ffa?ixlib=rb-4.0.3&auto=format&fit=crop&w-1350&q=80" class="category-img" alt="Luxury Fabrics">
                    <h4 class="category-name">Luxury Fabrics</h4>
                    <div class="category-count">68 Products</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" class="category-img" alt="Embroideries">
                    <h4 class="category-name">Embroideries</h4>
                    <div class="category-count">52 Products</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" class="category-img" alt="Fancy Collection">
                    <h4 class="category-name">Fancy Collection</h4>
                    <div class="category-count">37 Products</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Slider -->
    <div class="container image-slider">
        <h2 class="section-title">Our Collections</h2>
        <div id="fabricSlider" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="slider-item">
                        <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80" class="slider-img" alt="Fabrics Collection 1">
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="slider-item">
                        <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80" class="slider-img" alt="Fabrics Collection 2">
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="slider-item">
                        <img src="https://images.unsplash.com/photo-1567401893414-76b7b1e5a7a5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80" class="slider-img" alt="Fabrics Collection 3">
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#fabricSlider" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#fabricSlider" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            <div class="slider-dots mt-3">
                <div class="slider-dot active" data-bs-target="#fabricSlider" data-bs-slide-to="0"></div>
                <div class="slider-dot" data-bs-target="#fabricSlider" data-bs-slide-to="1"></div>
                <div class="slider-dot" data-bs-target="#fabricSlider" data-bs-slide-to="2"></div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h4 class="footer-title">Jaans<span>Fabrics</span></h4>
                    <p>Providing premium quality fabrics and embroideries since 2010. Our commitment to quality and customer satisfaction makes us the preferred choice for luxury fabrics.</p>
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
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Collections</a></li>
                        <li><a href="#">New Arrivals</a></li>
                        <li><a href="#">Best Sellers</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="footer-title">Categories</h5>
                    <ul class="footer-links">
                        <li><a href="#">Masterpieces</a></li>
                        <li><a href="#">Luxury Fabrics</a></li>
                        <li><a href="#">Embroideries</a></li>
                        <li><a href="#">Fancy Collection</a></li>
                        <li><a href="#">Winter Collection</a></li>
                        <li><a href="#">Summer Collection</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h5 class="footer-title">Contact Info</h5>
                    <ul class="footer-links">
                        <li><i class="fas fa-map-marker-alt me-2"></i> Main Street, Lahore, Pakistan</li>
                        <li><i class="fas fa-phone me-2"></i> +92 300 1234567</li>
                        <li><i class="fas fa-envelope me-2"></i> info@jaansfabrics.com</li>
                        <li><i class="fas fa-clock me-2"></i> Mon-Sat: 10AM - 8PM</li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2023 JaansFabrics.com. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Filter Offcanvas -->
    <div class="offcanvas offcanvas-end offcanvas-filter" tabindex="-1" id="filterOffcanvas" aria-labelledby="filterOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="filterOffcanvasLabel"><i class="fas fa-filter me-2"></i>Filters</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="mb-4">
                <h6 class="filter-title">Category</h6>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="offcanvasCategory1" checked>
                    <label class="form-check-label" for="offcanvasCategory1">Men</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="offcanvasCategory2">
                    <label class="form-check-label" for="offcanvasCategory2">Women</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="offcanvasCategory3">
                    <label class="form-check-label" for="offcanvasCategory3">Winter</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="offcanvasCategory4">
                    <label class="form-check-label" for="offcanvasCategory4">Summer</label>
                </div>
            </div>
            
            <div class="mb-4">
                <h6 class="filter-title">Sub Brand</h6>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="offcanvasBrand1">
                    <label class="form-check-label" for="offcanvasBrand1">Masterpieces</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="offcanvasBrand2" checked>
                    <label class="form-check-label" for="offcanvasBrand2">Luxury Fabrics</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="offcanvasBrand3">
                    <label class="form-check-label" for="offcanvasBrand3">Embroideries</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="offcanvasBrand4">
                    <label class="form-check-label" for="offcanvasBrand4">Fancy Collection</label>
                </div>
            </div>
            
            <div class="mb-4">
                <h6 class="filter-title">Price Range</h6>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="offcanvasPriceRange" id="offcanvasPrice1" checked>
                    <label class="form-check-label" for="offcanvasPrice1">Low to High</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="offcanvasPriceRange" id="offcanvasPrice2">
                    <label class="form-check-label" for="offcanvasPrice2">High to Low</label>
                </div>
            </div>
            
            
            <button class="btn-apply-filters" data-bs-dismiss="offcanvas">Apply Filters</button>
            <button class="btn btn-outline-dark w-100 mt-2" id="resetOffcanvasFilters">Reset All</button>
        </div>
    </div>

    <!-- Chat Widget -->
    <div class="chat-widget">
        <div class="chat-options" id="chatOptions">
            <a href="#" class="chat-option">
                <i class="fab fa-whatsapp" style="color: #25D366;"></i> Chat on WhatsApp
            </a>
            <a href="#" class="chat-option">
                <i class="fas fa-comment" style="color: var(--primary-gold-solid);"></i> Live Chat
            </a>
            <a href="#" class="chat-option">
                <i class="fab fa-facebook-messenger" style="color: #006AFF;"></i> Messenger
            </a>
            <a href="#" class="chat-option">
                <i class="fas fa-phone" style="color: var(--primary-gold-solid);"></i> Call Us
            </a>
        </div>
        <div class="chat-button" id="chatButton">
            <i class="fas fa-comments"></i>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        // Chat widget toggle
        document.getElementById('chatButton').addEventListener('click', function() {
            const chatOptions = document.getElementById('chatOptions');
            chatOptions.classList.toggle('show');
        });
        
        // Close chat options when clicking outside
        document.addEventListener('click', function(event) {
            const chatButton = document.getElementById('chatButton');
            const chatOptions = document.getElementById('chatOptions');
            
            if (!chatButton.contains(event.target) && !chatOptions.contains(event.target)) {
                chatOptions.classList.remove('show');
            }
        });
        
        // Update slider dots on slide
        const fabricSlider = document.getElementById('fabricSlider');
        const sliderDots = document.querySelectorAll('.slider-dot');
        
        fabricSlider.addEventListener('slid.bs.carousel', function() {
            const activeIndex = Array.from(fabricSlider.querySelectorAll('.carousel-item')).findIndex(item => item.classList.contains('active'));
            
            sliderDots.forEach((dot, index) => {
                if (index === activeIndex) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        });
        
        // Click on slider dots to navigate
        sliderDots.forEach((dot, index) => {
            dot.addEventListener('click', function() {
                const carousel = new bootstrap.Carousel(fabricSlider);
                carousel.to(index);
            });
        });
        // Filter functionality
        let currentSort = 'best';
        let activeCategories = ['men', 'winter'];
        let activeBrands = ['luxury'];
        let priceSort = 'low';
        
        // Initialize filters
        function initFilters() {
            // Filter checkboxes
            const categoryCheckboxes = document.querySelectorAll('#filterOffcanvas input[type="checkbox"][id^="offcanvasCategory"]');
            const brandCheckboxes = document.querySelectorAll('#filterOffcanvas input[type="checkbox"][id^="offcanvasBrand"]');
            const priceRadios = document.querySelectorAll('#filterOffcanvas input[type="radio"][name="offcanvasPriceRange"]');
            
            // Sort dropdowns
            const sortDropdownItems = document.querySelectorAll('.dropdown-item[data-sort]');
            const offcanvasSortItems = document.querySelectorAll('#filterOffcanvas .dropdown-item[data-sort]');
            
            // Apply filter buttons
            const applyFilterBtn = document.querySelector('.btn-apply-filters');
            
            // Reset filters button
            const resetBtn = document.getElementById('resetOffcanvasFilters');
            
            // Update active categories
            function updateCategories() {
                activeCategories = [];
                if (document.getElementById('offcanvasCategory1').checked) {
                    activeCategories.push('men');
                }
                if (document.getElementById('offcanvasCategory2').checked) {
                    activeCategories.push('women');
                }
                if (document.getElementById('offcanvasCategory3').checked) {
                    activeCategories.push('winter');
                }
                if (document.getElementById('offcanvasCategory4').checked) {
                    activeCategories.push('summer');
                }
            }
            
            // Update active brands
            function updateBrands() {
                activeBrands = [];
                if (document.getElementById('offcanvasBrand1').checked) {
                    activeBrands.push('masterpieces');
                }
                if (document.getElementById('offcanvasBrand2').checked) {
                    activeBrands.push('luxury');
                }
                if (document.getElementById('offcanvasBrand3').checked) {
                    activeBrands.push('embroidery');
                }
                if (document.getElementById('offcanvasBrand4').checked) {
                    activeBrands.push('fancy');
                }
            }
            
            // Update price sort
            function updatePriceSort() {
                if (document.getElementById('offcanvasPrice1').checked) {
                    priceSort = 'low';
                } else if (document.getElementById('offcanvasPrice2').checked) {
                    priceSort = 'high';
                }
            }
            
            // Apply filters and sort
            function applyFilters() {
                updateCategories();
                updateBrands();
                updatePriceSort();
                
                const products = document.querySelectorAll('.product-item');
                let visibleProducts = [];
                
                // Filter products
                products.forEach(product => {
                    const categories = product.getAttribute('data-category').split(' ');
                    const brand = product.getAttribute('data-brand');
                    const price = parseInt(product.getAttribute('data-price'));
                    
                    // Check category match
                    const categoryMatch = activeCategories.length === 0 || 
                        activeCategories.some(cat => categories.includes(cat));
                    
                    // Check brand match
                    const brandMatch = activeBrands.length === 0 || 
                        activeBrands.includes(brand);
                    
                    if (categoryMatch && brandMatch) {
                        product.style.display = 'block';
                        visibleProducts.push({
                            element: product,
                            title: product.querySelector('.product-title').textContent,
                            price: price
                        });
                    } else {
                        product.style.display = 'none';
                    }
                });
                
                // Sort products
                sortProducts(visibleProducts);
                
                // Update product grid
                const productGrid = document.getElementById('productGrid');
                visibleProducts.forEach(item => {
                    productGrid.appendChild(item.element);
                });
            }
            
            // Sort products
            function sortProducts(products) {
                switch(currentSort) {
                    case 'best':
                        // Keep original order for best selling
                        break;
                    case 'a-z':
                        products.sort((a, b) => a.title.localeCompare(b.title));
                        break;
                    case 'z-a':
                        products.sort((a, b) => b.title.localeCompare(a.title));
                        break;
                    case 'old':
                        // Assuming first products are older
                        break;
                    case 'new':
                        products.reverse();
                        break;
                    case 'low':
                        products.sort((a, b) => a.price - b.price);
                        break;
                    case 'high':
                        products.sort((a, b) => b.price - a.price);
                        break;
                }
                
                // Apply price sort if selected
                if (priceSort === 'low') {
                    products.sort((a, b) => a.price - b.price);
                } else if (priceSort === 'high') {
                    products.sort((a, b) => b.price - a.price);
                }
            }
            
            // Update sort button text
            function updateSortText(sortType) {
                let text = 'Sort by: ';
                switch(sortType) {
                    case 'best': text += 'Best Selling'; break;
                    case 'a-z': text += 'Alphabetically A-Z'; break;
                    case 'z-a': text += 'Alphabetically Z-A'; break;
                    case 'old': text += 'Old to New'; break;
                    case 'new': text += 'New to Old'; break;
                    case 'low': text += 'Price Low to High'; break;
                    case 'high': text += 'Price High to Low'; break;
                }
                
                // Update all sort buttons
                document.getElementById('productSort').textContent = text;
                document.getElementById('offcanvasSort').textContent = text.split(': ')[1];
            }
            
            // Event listeners for filter checkboxes
            categoryCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', applyFilters);
            });
            
            brandCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', applyFilters);
            });
            
            priceRadios.forEach(radio => {
                radio.addEventListener('change', applyFilters);
            });
            
            // Event listeners for sort dropdowns
            sortDropdownItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    currentSort = this.getAttribute('data-sort');
                    updateSortText(currentSort);
                    applyFilters();
                });
            });
            
            offcanvasSortItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    currentSort = this.getAttribute('data-sort');
                    updateSortText(currentSort);
                    applyFilters();
                });
            });
            
            // Apply filter button
            if (applyFilterBtn) {
                applyFilterBtn.addEventListener('click', applyFilters);
            }
            
            // Reset filters
            if (resetBtn) {
                resetBtn.addEventListener('click', function() {
                    // Reset checkboxes
                    document.getElementById('offcanvasCategory1').checked = true;
                    document.getElementById('offcanvasCategory2').checked = false;
                    document.getElementById('offcanvasCategory3').checked = false;
                    document.getElementById('offcanvasCategory4').checked = false;
                    
                    document.getElementById('offcanvasBrand1').checked = false;
                    document.getElementById('offcanvasBrand2').checked = true;
                    document.getElementById('offcanvasBrand3').checked = false;
                    document.getElementById('offcanvasBrand4').checked = false;
                    
                    document.getElementById('offcanvasPrice1').checked = true;
                    
                    // Reset sort
                    currentSort = 'best';
                    updateSortText('best');
                    
                    // Apply filters
                    applyFilters();
                });
            }
            
            // Initialize
            applyFilters();
        }
        
        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', initFilters);
    </script>
</body>
</html>