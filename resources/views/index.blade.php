<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>LuxMar</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{ asset('fav.png') }}" rel="icon">

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
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/bootstrap.css') }}" />
    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
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
                @include('partitions.subnavbar')
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
                            <span class="text-muted" style="text-decoration: line-through;">{{ $produit->oldPrice
                                }} DH </span> <br>
                            <b>{{ $produit->price }} DH </b>
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
                <div class="position-relative text-center text-md-center text-white mb-2 py-5 px-5"
                    style="background-color : #E48F45;">
                    <img src="img/offer-1.png" alt="">
                    <div class="position-relative" style="z-index: 1;">
                        <h5 class="text-uppercase mb-3">Les Réductions sur les produits</h5>
                        <h1 class="mb-4 font-weight-semi-bold">Consulter les différents famiiles</h1>
                        <a href="{{ route('lesoffres') }}"
                            class="btn btn-outline-primary text-dark py-md-2 px-md-3">Consulter</a>
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
                                <span class="text-muted" style="text-decoration: line-through;">{{ $produit->oldPrice
                                    }} DH </span> <br>
                                <b>{{ $produit->price }} DH </b>
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


    <section class="partners-section">
        <div class="container">
            <h2>Nos Partenaires</h2>
            <div class="partners-grid">
                @foreach ($partenaires as $par)
                <div class="partner">
                    <img src="{{asset('storage/'.$par->logo)}}" alt="Partner 1" style="width:200px; height:110px;">
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <style>
        .partners-section {
            padding: 50px 0;
            background-color: #f9f9f9;
            text-align: center;
        }

        .partners-section h2 {
            margin-bottom: 30px;
        }

        .partners-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            justify-items: center;
        }

        .partner img {
            max-width: 200px;
            height: auto;
        }
    </style>



    <!-- client section -->

    <!-- info section -->
    <section class="container client_section layout_padding-bottom mt-3">
        <div class="container">
            <div class="heading_container heading_center">
                <h2 class="text-center">
                    Avis de Nos Clients
                </h2>
            </div>
        </div>
        <div class="client_container">
            @foreach ($opinions as $o)
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="testo">
                    <img src="{{ asset('storage/'.$o->photo) }}" alt="Avatar" style="width:90px">
                    <p><span>{{ $o->name }}</span></p>
                    <p class="text-center"><strong class="fs-5 text-warning">"</strong> {{ $o->opinion }} <strong
                            class="fs-5 text-warning">"</strong>
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <style>
        .testo {
            border: 2px solid #ccc;
            background-color: #eee;
            border-radius: 5px;
            padding: 16px;
            margin: 16px 0
        }

        .testo::after {
            content: "";
            clear: both;
            display: table;
        }

        .testo img {
            float: left;
            margin-right: 20px;
            border-radius: 50%;
        }

        .testo span {
            font-size: 20px;
            margin-right: 15px;
        }

        @media (max-width: 500px) {
            .testo {
                text-align: center;
            }

            .testo img {
                margin: auto;
                float: none;
                display: block;
            }
        }
    </style>
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
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div>
        </div>
    </section>








    <!-- Footer Start -->
    @include('partitions.footer')
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