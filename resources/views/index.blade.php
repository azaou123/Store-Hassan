<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>EShopper - Bootstrap Shop Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="{{ asset('front/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('front/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>
    @if(session('successCommande'))
    <script>
        // Show alert with z-index 2
        alert('La Commande Est Envoyé Avec succès, Merci !');
        localStorage.clear();
        // Delete the session variable after 5 seconds
        setTimeout(function () {
            @php
            session() -> forget('successCommande');
            @endphp
        }, 5000);
    </script>
    @endif

    <!-- Topbar Start -->
    @include('partitions.navbar')
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
                    data-toggle="collapse" href="#navbar-vertical"
                    style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0"
                    id="navbar-vertical">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        @foreach ($categories as $cat)
                        <a href="{{ route('prodCat', $cat->id) }}" class="nav-item nav-link">{{$cat->label}}</a>
                        @endforeach
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a class="" href="{{ route('index') }}">
                        <img src="{{ asset('storage/'.$parametres->logo) }}" alt="Logo" class="img-fluid rounded mb-2"
                            style="width:170px; height : 60px;">
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.html" class="nav-item nav-link active">Home</a>
                            <a href="shop.html" class="nav-item nav-link">Shop</a>
                            <a href="detail.html" class="nav-item nav-link">Shop Detail</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="cart.html" class="dropdown-item">Shopping Cart</a>
                                    <a href="checkout.html" class="dropdown-item">Checkout</a>
                                </div>
                            </div>
                            <a href="contact.html" class="nav-item nav-link">Contact</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0">
                            <a href="" class="nav-item nav-link"></a>
                            <a href="" class="nav-item nav-link">Register</a>
                        </div>
                    </div>
                </nav>
                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @php
                        $i=0 ;
                        @endphp
                        @foreach ($categories as $cat)
                        @php
                        $folderPath = public_path('storage/'.$cat->repPhotos);
                        $imageFiles = File::allFiles($folderPath);
                        @endphp
                        <div class="carousel-item <?php if ($i==0) echo 'active'; ?>" style="height: 410px;">
                            <img class="img-fluid"
                                src="{{ asset('storage/' . $cat->repPhotos . '/' . $imageFiles[0]->getFilename()) }}"
                                alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h4 class="text-light text-uppercase font-weight-medium mb-3">
                                        {{ $cat->description }}
                                    </h4>
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">{{ $cat->label }}</h3>
                                    <a href="{{ route('prodCat', $cat->id) }}" class="btn btn-light py-2 px-3">Voir
                                        Plus</a>
                                </div>
                            </div>
                        </div>
                        @php
                        $i++;
                        @endphp
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Featured Start -->
    <!-- <div class="container-fluid pt-3">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-4 col-md-4 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 10px;">
                    <h4 class="fas fa-shopping-cart text-primary m-0 mr-3"></h4>
                    <h5 class="font-weight-semi-bold m-0">Choisir les produits</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 10px;">
                    <h4 class="fas fa-clipboard-check text-primary m-0 mr-2"></h4>
                    <h5 class="font-weight-semi-bold m-0">Valider le formulaire</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 10px;">
                    <h4 class="fas fa-phone-alt text-primary m-0 mr-3"></h4>
                    <h5 class="font-weight-semi-bold m-0">Manager va vous contacter</h5>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Featured End -->


    <!-- Categories Start -->
    <div class="container px-4 px-lg-5 mt-5">
        <div id="productContainer"
            class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-xl-4 justify-content-center">
            @foreach ($produits as $produit)
            <div class="col mb-5">
                <div class="card h-100">
                    @if ($produit->repPhotos)
                    @php
                    $folderPath = public_path('storage/'.$produit->repPhotos);
                    $imgs = File::files($folderPath);
                    $imageFiles = [];
                    foreach ($imgs as $im){
                    if (in_array(strtolower(pathinfo($im, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png','gif'])){
                    array_push($imageFiles,$im);
                    }
                    }
                    @endphp
                    <!-- Product image from the first file in the directory -->
                    <img class="card-img-top"
                        src="{{ asset('storage/' . $produit->repPhotos . '/' . $imageFiles[0]->getFilename()) }}"
                        alt="..." style="height: 250px; object-fit: cover;">
                    @else
                    <!-- Placeholder image when no images are found -->
                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..."
                        style="height: 250px;">
                    @endif
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">{{ $produit->label }}</h5>
                            <!-- Product reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <!-- Product price-->
                            <span class="text-muted text-decoration-line-through">{{ $produit->oldPrice }}</span>
                            <b>{{ $produit->price }}</b>
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            <a class="btn btn-primary text-light fw-bold fs-6 btn-outline-dark mt-auto"
                                onclick="addToCart({{ $produit->id }},'{{ $produit->label }}', {{ $produit->price }})">
                                <i class="fas fa-cart-plus"></i> <!-- Font Awesome cart icon -->
                            </a>
                            <a class="btn btn-success text-light fw-bold fs-6 btn-outline-dark mt-auto"
                                href="{{ route('produitdetails', ['produit' => $produit->id]) }}">
                                <i class="fas fa-info-circle"></i> <!-- Font Awesome info icon -->
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- Categories End -->


    <!-- Offer Start -->
    <div class="container-fluid offer pt-5">
        <div class="row px-xl-5">
            <div class="col-md-12 pb-4">
                <div class="position-relative bg-secondary text-center text-md-center text-white mb-2 py-5 px-5">
                    <img src="img/offer-1.png" alt="">
                    <div class="position-relative" style="z-index: 1;">
                        <h5 class="text-uppercase text-primary mb-3">Les Réductions sur les produits</h5>
                        <h1 class="mb-4 font-weight-semi-bold">Consulter les différents famiiles</h1>
                        <a href="{{ route('lesoffres') }}" class="btn btn-outline-primary py-md-2 px-md-3">Consulter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Ajoutés Dernièrement</span></h2>
        </div>

        <div class="container px-4 px-lg-5 mt-5">
            <div id="productContainer"
                class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-xl-4 justify-content-center">
                @foreach ($produits as $produit)
                <div class="col mb-5">
                    <div class="card h-100">
                        @if ($produit->repPhotos)
                        @php
                        $folderPath = public_path('storage/'.$produit->repPhotos);
                        $imgs = File::files($folderPath);
                        $imageFiles = [];
                        foreach ($imgs as $im){
                        if (in_array(strtolower(pathinfo($im, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png','gif'])){
                        array_push($imageFiles,$im);
                        }
                        }
                        @endphp
                        <!-- Product image from the first file in the directory -->
                        <img class="card-img-top"
                            src="{{ asset('storage/' . $produit->repPhotos . '/' . $imageFiles[0]->getFilename()) }}"
                            alt="..." style="height: 250px; object-fit: cover;">
                        @else
                        <!-- Placeholder image when no images are found -->
                        <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..."
                            style="height: 250px;">
                        @endif
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">{{ $produit->label }}</h5>
                                <!-- Product reviews-->
                                <div class="d-flex justify-content-center small text-warning mb-2">
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                </div>
                                <!-- Product price-->
                                <span class="text-muted text-decoration-line-through">{{ $produit->oldPrice }}</span>
                                <b>{{ $produit->price }}</b>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <a class="btn btn-primary text-light fw-bold fs-6 btn-outline-dark mt-auto"
                                    onclick="addToCart({{ $produit->id }},'{{ $produit->label }}', {{ $produit->price }})">
                                    <i class="fas fa-cart-plus"></i> <!-- Font Awesome cart icon -->
                                </a>
                                <a class="btn btn-success text-light fw-bold fs-6 btn-outline-dark mt-auto"
                                    href="{{ route('produitdetails', ['produit' => $produit->id]) }}">
                                    <i class="fas fa-info-circle"></i> <!-- Font Awesome info icon -->
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
    <!-- Products End -->


    <!-- Subscribe Start -->
    <!-- <div class="container-fluid bg-secondary my-5">
        <div class="row justify-content-md-center py-5 px-xl-5">
            <div class="col-md-6 col-12 py-5">
                <div class="text-center mb-2 pb-2">
                    <h2 class="section-title px-5 mb-3"><span class="bg-secondary px-2">Stay Updated</span></h2>
                    <p>Amet lorem at rebum amet dolores. Elitr lorem dolor sed amet diam labore at justo ipsum eirmod
                        duo labore labore.</p>
                </div>
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-white p-4" placeholder="Email Goes Here">
                        <div class="input-group-append">
                            <button class="btn btn-primary px-4">Subscribe</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> -->
    <!-- Subscribe End -->


    <section class="section section-default mt-none mb-none">
        <div class="container">
            <h2 class="mb-sm text-center my-5">Nos <strong>Partenaires</strong></h2>
            <strong>
                <div class="row">
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="square-holder">
                            <img alt=""
                                src="https://www.pmits.co.uk/portals/0/images/partners/solar-communications-200.png" />
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="square-holder">
                            <img alt="" src="https://www.pmits.co.uk/portals/0/images/partners/cbf-200.png" />
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="square-holder">
                            <img alt="" src="https://www.pmits.co.uk/portals/0/images/partners/gxs-200.png" />
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="square-holder">
                            <img alt="" src="https://www.pmits.co.uk/portals/0/images/partners/jpr-200.png" />
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="square-holder">
                            <img alt="" src="https://www.pmits.co.uk/portals/0/images/partners/talk-internet-200.png" />
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="square-holder">
                            <img alt="" src="https://www.pmits.co.uk/Portals/0/img/opera3_logo.png" />
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="square-holder">
                            <img alt="" src="https://www.pmits.co.uk/Portals/0/pegasus-logo.png" />
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="square-holder">
                            <img alt="" src="https://www.pmits.co.uk/Portals/0/sage business partner.jpg" />
                        </div>
                    </div>
                </div>
            </strong>
        </div>
    </section>
    <style>
        .square-holder {
            padding: 30px;
            border: 1px solid #cecece;
            align-items: center;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            background-color: #f1f1f1;
            min-height: 200px
        }

        .square-holder img {
            max-width: 100%;
            filter: grayscale(100%);
            transition: all 0.3s;
        }

        .square-holder:hover img {
            filter: none;
        }
    </style>



    <!-- client section -->

    <section class="client_section layout_padding-bottom">
        <div class="container">
            <div class="heading_container heading_center">
                <h2 class="text-center my-3">
                    Avis de Nos Clients
                </h2>
            </div>
        </div>
        <div class="client_container ">
            <div id="carouselExample2Controls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($opinions as $testimonial)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <div class="container">
                            <div class="box">
                                <div class="detail-box">
                                    <p>
                                        <i class="fa fa-quote-left" aria-hidden="true"></i>
                                    </p>
                                    <p>
                                        {{ $testimonial->opinion }}
                                    </p>
                                </div>
                                <div class="client-id">
                                    <div class="img-box">
                                        @if (isset($testimonial->photo))
                                        <img src="{{ asset('storage/'.$testimonial->photo) }}"
                                            alt="{{ $testimonial->name }}" style="width:50px; height:50px;">
                                        @else
                                        <img src="{{ asset('front/images/client.jpg') }}" alt="{{ $testimonial->name }}"
                                            style="width:50px; height:50px;">
                                        @endif

                                    </div>
                                    <div class="name">
                                        <h5>
                                            {{ $testimonial->name }}
                                        </h5>
                                        <h6>
                                            {{ $testimonial->occupation }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="carousel_btn-box">
                    <a class="carousel-control-prev" href="#carouselExample2Controls" role="button" data-slide="prev">
                        <span>
                            <i class="fa fa-angle-left" aria-hidden="true"></i>
                        </span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExample2Controls" role="button" data-slide="next">
                        <span>
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- end client section -->


    <!-- Contact Section -->
    <section class="container my-5">
        <h2 class="text-center my-4">Contactez Nous </h2>
        <div class="row">
            <div class="col-md-6">
                <!-- Add this script tag to the <head> of your HTML file -->
                <!-- generated by : https://embed-googlemap.com/ -->
                <div class="mapouter">
                    <div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no"
                            marginheight="0" marginwidth="0"
                            src="https://maps.google.com/maps?width=802&amp;height=416&amp;hl=en&amp;q={{ $parametres->googlemaps }}&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a
                            href="https://embed-googlemap.com">google maps code generator</a></div>
                    <style>
                        .mapouter {
                            position: relative;
                            text-align: right;
                            width: 100%;
                            height: 416px;
                        }

                        .gmap_canvas {
                            overflow: hidden;
                            background: none !important;
                            width: 100%;
                            height: 416px;
                        }

                        .gmap_iframe {
                            height: 416px !important;
                        }
                    </style>
                </div>
            </div>
            <div class="col-md-6 mt-2">
                <form action="{{ route('contact') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="nomComplet" class="form-label">Nom Complet</label>
                        <input type="text" class="form-control" id="nomComplet" name="nomComplet" required>
                    </div>
                    <div class="mb-3">
                        <label for="telephone" class="form-label">Téléphone</label>
                        <input type="tel" class="form-control" id="telephone" name="telephone" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Your Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </section>








    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
            </ul>
            <p class="text-center text-muted">© 2021 Company, Inc</p>
        </footer>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('front/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('front/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('front/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('front/mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>