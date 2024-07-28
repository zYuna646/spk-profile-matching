<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ultras - Clothing Store eCommerce Store HTML Website Template</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/normalize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('home/icomoon/icomoon.css') }}">
    <link rel="stylesheet" type="text/css" media="all"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/vendor.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- script
    ================================================== -->
    <script src="{{ asset('home/js/modernizr.js') }}"></script>
</head>

<body>

    <div class="preloader-wrapper">
        <div class="preloader">
        </div>
    </div>

    <div class="search-popup">
        <div class="search-popup-container">

            <form role="search" method="get" class="search-form" action="">
                <input type="search" id="search-form" class="search-field" placeholder="Type and press enter"
                    value="" name="s" />
                <button type="submit" class="search-submit"><a href="#"><i
                            class="icon icon-search"></i></a></button>
            </form>

            <h5 class="cat-list-title">Browse Categories</h5>

            <ul class="cat-list">
                <li class="cat-list-item">
                    <a href="shop.html" title="Men Jackets">Men Jackets</a>
                </li>
                <li class="cat-list-item">
                    <a href="shop.html" title="Fashion">Fashion</a>
                </li>
                <li class="cat-list-item">
                    <a href="shop.html" title="Casual Wears">Casual Wears</a>
                </li>
                <li class="cat-list-item">
                    <a href="shop.html" title="Women">Women</a>
                </li>
                <li class="cat-list-item">
                    <a href="shop.html" title="Trending">Trending</a>
                </li>
                <li class="cat-list-item">
                    <a href="shop.html" title="Hoodie">Hoodie</a>
                </li>
                <li class="cat-list-item">
                    <a href="shop.html" title="Kids">Kids</a>
                </li>
            </ul>
        </div>
    </div>
    <header id="header">
        <div id="header-wrap">
            <nav class="secondary-nav border-bottom">
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-4 header-contact">
                            <p>Contact Panitia <strong>+57 444 11 00 35</strong>
                            </p>
                        </div>
                        <div class="col-md-4 shipping-purchase text-center">
                            <p>PPAN 2024</p>
                        </div>
                        <div class="col-md-4 col-sm-12 user-items">
                            <ul class="d-flex justify-content-end list-unstyled">
                                <li>
                                    <a href="login.html">
                                        <i class="icon icon-user"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="cart.html">
                                        <i class="icon icon-shopping-cart"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="wishlist.html">
                                        <i class="icon icon-heart"></i>
                                    </a>
                                </li>
                                <li class="user-items search-item pe-3">
                                    <a href="#" class="search-button">
                                        <i class="icon icon-search"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <nav class="primary-nav padding-small">
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-2 col-md-2">
                            <div class="main-logo">
                                <a href="index.html">
                                    <img width="200px" src="{{ asset('home/images/logo1.png') }}" alt="logo">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-10 col-md-10">
                            <div class="navbar">

                                <div id="main-nav" class="stellarnav d-flex justify-content-end right">
                                    <ul class="menu-list">

                                        <li class="menu-item has-sub">
                                            <a href="index.html" class="item-anchor active d-flex align-item-center"
                                                data-effect="Home">Home</i></a>


                                        <li><a href="about.html" class="item-anchor" data-effect="About">About</a>
                                        </li>

                                        <li class="menu-item has-sub">
                                            <a href="{{route('dashboard.alumni')}}" class="item-anchor d-flex align-item-center"
                                                data-effect="Shop">Alumni</i></a>
                                        </li>


                                        <li><a href="contact.html" class="item-anchor"
                                                data-effect="Contact">Contact</a></li>

                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <section id="billboard" class="overflow-hidden">

        <button class="button-prev">
            <i class="icon icon-chevron-left"></i>
        </button>
        <button class="button-next">
            <i class="icon icon-chevron-right"></i>
        </button>
        <div class="swiper main-swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide"
                    style="background-image: url('{{ asset('home/images/ppan.jpg') }}');background-repeat: no-repeat;background-size: cover;background-position: center;">
                    <div class="banner-content">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2 class="banner-title" style="color: white; box-shadow: 20px; ">PPAN 2024</h2>
                                    <p style="color: white;">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Sed eu feugiat amet, libero ipsum enim pharetra hac.</p>
                                    <div class="btn-wrap">
                                        <a href="{{route('login')}}" class="btn btn-light btn-medium d-flex align-items-center"
                                            tabindex="0">Daftar PPAN <i class="icon icon-arrow-io"></i>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide"
                    style="background-image: url('images/banner2.jpg');background-repeat: no-repeat;background-size: cover;background-position: center;">
                    <div class="banner-content">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2 class="banner-title">Casual Collection</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu feugiat amet,
                                        libero ipsum enim pharetra hac.</p>
                                    <div class="btn-wrap">
                                        <a href="shop.html"
                                            class="btn btn-light btn-light-arrow btn-medium d-flex align-items-center"
                                            tabindex="0">Shop it now <i class="icon icon-arrow-io"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="featured-products" class="product-store padding-large">
        <div class="container">
            <div class="section-header d-flex flex-wrap align-items-center justify-content-between">
                <h2 class="section-title">Alumni Kami</h2>
                <div class="btn-wrap">
                    <a href="{{route('dashboard.alumni')}}" class="d-flex align-items-center">Lihat Semua Alumni <i
                            class="icon icon icon-arrow-io"></i></a>
                </div>
            </div>
            <div class="swiper product-swiper overflow-hidden">
                <div class="swiper-wrapper">
                    @foreach ($alumni as $item)
                        <div class="swiper-slide">
                            <div class="product-item">
                                <div class="image-holder">
                                    <img src="{{  asset('storage/' . $item->foto) }}" alt="Books"
                                        class="product-image">
                                </div>
                                <div class="cart-concern">
                                    <div class="cart-button d-flex justify-content-between align-items-center">
                                        <button type="button"
                                            class="btn-wrap cart-link d-flex align-items-center">add to cart <i
                                                class="icon icon-arrow-io"></i>
                                        </button>
                                        <button type="button"
                                            class="view-btn tooltip
                        d-flex">
                                            <i class="icon icon-screen-full"></i>
                                            <span class="tooltip-text">Quick view</span>
                                        </button>
                                        <button type="button" class="wishlist-btn">
                                            <i class="icon icon-heart"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <h3 class="product-title">
                                        <a href="single-product.html">{{$item->name}}</a>
                                    </h3>
                                    <span class="item-price text-primary">{{$item->tahun_start  . '-' . $item->tahun_end}}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>


    <section id="quotation" class="align-center padding-large">
        <div class="inner-content">
            <h2 class="section-title divider">Quote of the day</h2>
            <blockquote>
                <q>It's true, I don't like the whole cutoff-shorts-and-T-shirt look, but I think you can look fantastic
                    in casual clothes.</q>
                <div class="author-name">- Dr. Seuss</div>
            </blockquote>
        </div>
    </section>

    <hr>

    <section id="brand-collection" class="padding-medium bg-light-grey">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between">
                <img src="{{ asset('home/images/brand1.png') }}" alt="phone" class="brand-image">
                <img src="{{ asset('home/images/brand2.png') }}" alt="phone" class="brand-image">
                <img src="{{ asset('home/images/brand3.png') }}" alt="phone" class="brand-image">
                <img src="{{ asset('home/images/brand4.png') }}" alt="phone" class="brand-image">
                <img src="{{ asset('home/images/brand5.png') }}" alt="phone" class="brand-image">
            </div>
        </div>
    </section>

    <section id="instagram" class="padding-large">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Follow our instagram</h2>
            </div>
            <p>Our official Instagram account <a href="#">@ultras</a> or <a href="#">#ultras_clothing</a>
            </p>
            <div class="row d-flex flex-wrap justify-content-between">
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <figure class="zoom-effect">
                        <img src="images/insta-image1.jpg" alt="instagram" class="insta-image">
                        <i class="icon icon-instagram"></i>
                    </figure>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <figure class="zoom-effect">
                        <img src="images/insta-image2.jpg" alt="instagram" class="insta-image">
                        <i class="icon icon-instagram"></i>
                    </figure>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <figure class="zoom-effect">
                        <img src="images/insta-image3.jpg" alt="instagram" class="insta-image">
                        <i class="icon icon-instagram"></i>
                    </figure>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <figure class="zoom-effect">
                        <img src="images/insta-image4.jpg" alt="instagram" class="insta-image">
                        <i class="icon icon-instagram"></i>
                    </figure>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <figure class="zoom-effect">
                        <img src="images/insta-image5.jpg" alt="instagram" class="insta-image">
                        <i class="icon icon-instagram"></i>
                    </figure>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <figure class="zoom-effect">
                        <img src="images/insta-image6.jpg" alt="instagram" class="insta-image">
                        <i class="icon icon-instagram"></i>
                    </figure>
                </div>
            </div>
        </div>
    </section>


    <footer id="footer">
        <div class="container">
            <div class="footer-menu-list">
                <div class="row d-flex flex-wrap justify-content-between">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="footer-menu">
                            <h5 class="widget-title">Ultras</h5>
                            <ul class="menu-list list-unstyled">
                                <li class="menu-item">
                                    <a href="about.html">About us</a>
                                </li>
                                <li class="menu-item">
                                    <a href="#">Conditions </a>
                                </li>
                                <li class="menu-item">
                                    <a href="blog.html">Our Journals</a>
                                </li>
                                <li class="menu-item">
                                    <a href="#">Careers</a>
                                </li>
                                <li class="menu-item">
                                    <a href="#">Affiliate Programme</a>
                                </li>
                                <li class="menu-item">
                                    <a href="#">Ultras Press</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="footer-menu">
                            <h5 class="widget-title">Customer Service</h5>
                            <ul class="menu-list list-unstyled">
                                <li class="menu-item">
                                    <a href="faqs.html">FAQ</a>
                                </li>
                                <li class="menu-item">
                                    <a href="contact.html">Contact</a>
                                </li>
                                <li class="menu-item">
                                    <a href="#">Privacy Policy</a>
                                </li>
                                <li class="menu-item">
                                    <a href="#">Returns & Refunds</a>
                                </li>
                                <li class="menu-item">
                                    <a href="#">Cookie Guidelines</a>
                                </li>
                                <li class="menu-item">
                                    <a href="#">Delivery Information</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="footer-menu">
                            <h5 class="widget-title">Contact Us</h5>
                            <p>Do you have any questions or suggestions? <a href="#"
                                    class="email">ourservices@ultras.com</a>
                            </p>
                            <p>Do you need assistance? Give us a call. <br>
                                <strong>+57 444 11 00 35</strong>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="footer-menu">
                            <h5 class="widget-title">Forever 2018</h5>
                            <p>Cras mattis sit ornare in metus eu amet adipiscing enim. Ullamcorper in orci, ultrices
                                integer eget arcu. Consectetur leo dignissim lacus, lacus sagittis dictumst.</p>
                            <div class="social-links">
                                <ul class="d-flex list-unstyled">
                                    <li>
                                        <a href="#">
                                            <i class="icon icon-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon icon-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon icon-youtube-play"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon icon-behance-square"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </footer>

    <div id="footer-bottom">
        <div class="container">
            <div class="d-flex align-items-center flex-wrap justify-content-between">
                <div class="copyright">
                    <p>Freebies by <a href="https://templatesjungle.com/">Templates Jungle</a> Distributed by <a
                            href="https://themewagon.com">ThemeWagon</a>
                    </p>
                </div>
                <div class="payment-method">
                    <p>Payment options :</p>
                    <div class="card-wrap">
                        <img src="images/visa-icon.jpg" alt="visa">
                        <img src="images/mastercard.png" alt="mastercard">
                        <img src="images/american-express.jpg" alt="american-express">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('home/js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('home/js/plugins.js') }}"></script>
    <script src="{{ asset('home/js/script.js') }}"></script>
</body>

</html>
