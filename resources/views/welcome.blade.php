@extends('layouts.app')

@section('content')
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

<!-- Main Content -->
<div class="container mt-5">
    <!-- Products Header -->
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
                        <li><a class="dropdown-item" href="#" data-sort="low">Price Low to High</a></li>
                        <li><a class="dropdown-item" href="#" data-sort="high">Price High to Low</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="row" id="productGrid">
        <!-- Product 1 -->
        <div class="col-md-6 col-lg-4">
            <div class="product-card">
                <div class="product-badge gold-shimmer">BEST SELLER</div>
                <div class="product-image-container">
                    <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" class="product-front-img" alt="Premium Silk Embroidered">
                    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" class="product-back-img" alt="Premium Silk Embroidered Back">
                </div>
                <div class="product-info">
                    <h5 class="product-title">Premium Silk Embroidered</h5>
                    <div class="product-price">PKR 8,500</div>
                    <div class="product-colors">
                        <div class="color-dot" style="background-color: #D4AF37;"></div>
                        <div class="color-dot" style="background-color: #2C3E50;"></div>
                        <div class="color-dot" style="background-color: #7D3C98;"></div>
                        <div class="color-dot" style="background-color: #C0392B;"></div>
                    </div>
                    <div class="text-muted">Embroidered Silk | Winter Collection</div>
                </div>
            </div>
        </div>

        <!-- Product 2 -->
        <div class="col-md-6 col-lg-4">
            <div class="product-card">
                <div class="product-image-container">
                    <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" class="product-front-img" alt="Cotton Linen Blend">
                    <img src="https://images.unsplash.com/photo-1567401893414-76b7b1e5a7a5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" class="product-back-img" alt="Cotton Linen Blend Back">
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

        <!-- Product 3 -->
        <div class="col-md-6 col-lg-4">
            <div class="product-card">
                <div class="product-badge gold-shimmer">NEW</div>
                <div class="product-image-container">
                    <img src="https://images.unsplash.com/photo-1562157873-818bc0726f68?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" class="product-front-img" alt="Royal Velvet Collection">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" class="product-back-img" alt="Royal Velvet Collection Back">
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

        <!-- Product 4 -->
        <div class="col-md-6 col-lg-4">
            <div class="product-card">
                <div class="product-image-container">
                    <img src="https://images.unsplash.com/photo-1520004434532-668416a08753?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" class="product-front-img" alt="Sheer Chiffon Embroidered">
                    <img src="https://images.unsplash.com/photo-1544441893-675973e31985?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" class="product-back-img" alt="Sheer Chiffon Embroidered Back">
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

        <!-- Product 5 -->
        <div class="col-md-6 col-lg-4">
            <div class="product-card">
                <div class="product-badge gold-shimmer">LIMITED</div>
                <div class="product-image-container">
                    <img src="https://tailorbros.com/wp-content/uploads/2023/10/cotton-fabric-unveiled-best-cotton-types-for-mens-suits-3407-2.jpg" class="product-front-img" alt="Pure Wool Premium">
                    <img src="https://images.unsplash.com/photo-1519457431-44ccd64a579b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" class="product-back-img" alt="Pure Wool Premium Back">
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

        <!-- Product 6 -->
        <div class="col-md-6 col-lg-4">
            <div class="product-card">
                <div class="product-image-container">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQZQOTC-NUcdS64ezfaqkPTxI8dbonIIsCV6Q&s" class="product-front-img" alt="Sparkle Organza Collection">
                    <img src="https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" class="product-back-img" alt="Sparkle Organza Collection Back">
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
                <img src="https://images.unsplash.com/photo-1523380744952-b7e00e6e2ffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" class="category-img" alt="Luxury Fabrics">
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

<!-- Filter Offcanvas -->
<div class="offcanvas offcanvas-end offcanvas-filter" tabindex="-1" id="filterOffcanvas" aria-labelledby="filterOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="filterOffcanvasLabel"><i class="fas fa-filter me-2"></i>Filters</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form id="filterForm">
            <div class="mb-4">
                <h6 class="filter-title">Category</h6>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="categories[]" value="men" id="categoryMen" checked>
                    <label class="form-check-label" for="categoryMen">Men</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="categories[]" value="women" id="categoryWomen">
                    <label class="form-check-label" for="categoryWomen">Women</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="categories[]" value="winter" id="categoryWinter" checked>
                    <label class="form-check-label" for="categoryWinter">Winter</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="categories[]" value="summer" id="categorySummer">
                    <label class="form-check-label" for="categorySummer">Summer</label>
                </div>
            </div>

            <div class="mb-4">
                <h6 class="filter-title">Sub Brand</h6>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="brands[]" value="masterpieces" id="brandMasterpieces">
                    <label class="form-check-label" for="brandMasterpieces">Masterpieces</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="brands[]" value="luxury" id="brandLuxury" checked>
                    <label class="form-check-label" for="brandLuxury">Luxury Fabrics</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="brands[]" value="embroidery" id="brandEmbroidery">
                    <label class="form-check-label" for="brandEmbroidery">Embroideries</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="brands[]" value="fancy" id="brandFancy">
                    <label class="form-check-label" for="brandFancy">Fancy Collection</label>
                </div>
            </div>

            <div class="mb-4">
                <h6 class="filter-title">Price Range</h6>
                <div class="row">
                    <div class="col-6">
                        <input type="number" class="form-control" placeholder="Min" name="min_price" id="minPrice" value="0">
                    </div>
                    <div class="col-6">
                        <input type="number" class="form-control" placeholder="Max" name="max_price" id="maxPrice" value="20000">
                    </div>
                </div>
            </div>

            <button type="button" class="btn-apply-filters" onclick="applyFilters()">Apply Filters</button>
            <button type="button" class="btn btn-outline-dark w-100 mt-2" id="resetFilters">Reset All</button>
        </form>
    </div>
</div>
@endsection

@section('styles')
<style>
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

    .sort-dropdown .btn:hover,
    .sort-dropdown .btn:focus {
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

    .product-front-img,
    .product-back-img {
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

    .dropdown-filter .btn:hover,
    .dropdown-filter .btn:focus {
        border-color: var(--primary-gold-solid);
        box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.1);
    }

    .dropdown-filter .btn:after {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
    }

    .dropdown-item.active,
    .dropdown-item:active {
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

    .carousel-control-prev,
    .carousel-control-next {
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

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
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
</style>
@endsection

@section('scripts')
<script>
    // Filter functionality
    document.addEventListener('DOMContentLoaded', function() {
        const filterForm = document.getElementById('filterForm');
        const productGrid = document.getElementById('productGrid');
        const resetBtn = document.getElementById('resetFilters');

        // All products data
        const allProducts = [{
                id: 1,
                name: 'Premium Silk Embroidered',
                price: 8500,
                front_image: 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80',
                back_image: 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80',
                category: 'Embroidered Silk',
                collection: 'Winter Collection',
                is_bestseller: true,
                is_new: false,
                colors: ['#D4AF37', '#2C3E50', '#7D3C98', '#C0392B'],
                tags: ['men', 'winter', 'luxury']
            },
            {
                id: 2,
                name: 'Cotton Linen Blend',
                price: 5200,
                front_image: 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80',
                back_image: 'https://images.unsplash.com/photo-1567401893414-76b7b1e5a7a5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80',
                category: 'Premium Cotton',
                collection: 'Summer Collection',
                is_bestseller: false,
                is_new: false,
                colors: ['#ECF0F1', '#34495E', '#1ABC9C'],
                tags: ['men', 'summer', 'luxury']
            },
            {
                id: 3,
                name: 'Royal Velvet Collection',
                price: 12000,
                front_image: 'https://images.unsplash.com/photo-1562157873-818bc0726f68?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80',
                back_image: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80',
                category: 'Luxury Velvet',
                collection: 'Winter Collection',
                is_bestseller: false,
                is_new: true,
                colors: ['#2C3E50', '#7D3C98', '#C0392B'],
                tags: ['women', 'winter', 'luxury']
            },
            {
                id: 4,
                name: 'Sheer Chiffon Embroidered',
                price: 6800,
                front_image: 'https://images.unsplash.com/photo-1520004434532-668416a08753?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80',
                back_image: 'https://images.unsplash.com/photo-1544441893-675973e31985?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80',
                category: 'Embroidered Chiffon',
                collection: 'All Seasons',
                is_bestseller: false,
                is_new: false,
                colors: ['#FADBD8', '#D4EFDF', '#D6EAF8', '#FCF3CF'],
                tags: ['women', 'summer', 'embroidery']
            },
            {
                id: 5,
                name: 'Pure Wool Premium',
                price: 9500,
                front_image: 'https://tailorbros.com/wp-content/uploads/2023/10/cotton-fabric-unveiled-best-cotton-types-for-mens-suits-3407-2.jpg',
                back_image: 'https://images.unsplash.com/photo-1519457431-44ccd64a579b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80',
                category: '100% Wool',
                collection: 'Winter Collection',
                is_bestseller: false,
                is_new: false,
                colors: ['#5D6D7E', '#1C2833', '#641E16'],
                tags: ['men', 'winter', 'masterpieces']
            },
            {
                id: 6,
                name: 'Sparkle Organza Collection',
                price: 7200,
                front_image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQZQOTC-NUcdS64ezfaqkPTxI8dbonIIsCV6Q&s',
                back_image: 'https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80',
                category: 'Embellished Organza',
                collection: 'Party Wear',
                is_bestseller: false,
                is_new: false,
                colors: ['#F7DC6F', '#F0B27A', '#D7BDE2'],
                tags: ['women', 'fancy']
            }
        ];

        // Initial render
        renderProducts(allProducts);

        // Apply filters function
        window.applyFilters = function() {
            const formData = new FormData(filterForm);
            const selectedCategories = [];
            const selectedBrands = [];

            // Get selected categories
            const categoryCheckboxes = filterForm.querySelectorAll('input[name="categories[]"]:checked');
            categoryCheckboxes.forEach(cb => selectedCategories.push(cb.value));

            // Get selected brands
            const brandCheckboxes = filterForm.querySelectorAll('input[name="brands[]"]:checked');
            brandCheckboxes.forEach(cb => selectedBrands.push(cb.value));

            // Get price range
            const minPrice = parseFloat(document.getElementById('minPrice').value) || 0;
            const maxPrice = parseFloat(document.getElementById('maxPrice').value) || Infinity;

            // Filter products
            const filteredProducts = allProducts.filter(product => {
                // Check if product matches any selected category
                const categoryMatch = selectedCategories.length === 0 ||
                    selectedCategories.some(category => product.tags.includes(category));

                // Check if product matches any selected brand
                const brandMatch = selectedBrands.length === 0 ||
                    selectedBrands.some(brand => product.tags.includes(brand));

                // Check price range
                const priceMatch = product.price >= minPrice && product.price <= maxPrice;

                return categoryMatch && brandMatch && priceMatch;
            });

            // Render filtered products
            renderProducts(filteredProducts);
        };

        // Sort functionality
        document.querySelectorAll('.dropdown-item[data-sort]').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const sortType = this.getAttribute('data-sort');
                document.getElementById('productSort').textContent = 'Sort by: ' + this.textContent;

                // Get current products
                const productCards = Array.from(document.querySelectorAll('.product-card')).map(card => {
                    const productId = parseInt(card.closest('.col-md-6').dataset.productId);
                    return allProducts.find(p => p.id === productId);
                }).filter(p => p);

                // Sort products
                const sortedProducts = sortProducts(productCards, sortType);

                // Re-render sorted products
                renderProducts(sortedProducts);
            });
        });

        // Reset filters
        resetBtn.addEventListener('click', function() {
            filterForm.reset();
            renderProducts(allProducts);
        });

        // Render products to grid
        function renderProducts(products) {
            let html = '';
            products.forEach(product => {
                html += `
                <div class="col-md-6 col-lg-4" data-product-id="${product.id}">
                    <div class="product-card">
                        ${product.is_bestseller ? '<div class="product-badge gold-shimmer">BEST SELLER</div>' : ''}
                        ${product.is_new ? '<div class="product-badge gold-shimmer">NEW</div>' : ''}
                        
                        <div class="product-image-container">
                            <img src="${product.front_image}" class="product-front-img" alt="${product.name}">
                            ${product.back_image ? `<img src="${product.back_image}" class="product-back-img" alt="${product.name} Back">` : ''}
                        </div>
                        <div class="product-info">
                            <h5 class="product-title">${product.name}</h5>
                            <div class="product-price">PKR ${product.price.toLocaleString()}</div>
                            <div class="product-colors">
                                ${product.colors.map(color => `<div class="color-dot" style="background-color: ${color};"></div>`).join('')}
                            </div>
                            <div class="text-muted">${product.category} | ${product.collection}</div>
                        </div>
                    </div>
                </div>
                `;
            });

            productGrid.innerHTML = html;
        }

        // Sort products function
        function sortProducts(products, sortType) {
            const sorted = [...products];

            switch (sortType) {
                case 'best':
                    // Best selling first
                    sorted.sort((a, b) => (b.is_bestseller ? 1 : 0) - (a.is_bestseller ? 1 : 0));
                    break;
                case 'a-z':
                    sorted.sort((a, b) => a.name.localeCompare(b.name));
                    break;
                case 'z-a':
                    sorted.sort((a, b) => b.name.localeCompare(a.name));
                    break;
                case 'low':
                    sorted.sort((a, b) => a.price - b.price);
                    break;
                case 'high':
                    sorted.sort((a, b) => b.price - a.price);
                    break;
            }

            return sorted;
        }

        // Carousel functionality
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
    });
</script>
@endsection