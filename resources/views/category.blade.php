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
</head>

<body onload="
    document.getElementById('listCats').click();
">

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
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
                    data-toggle="collapse" href="#navbar-vertical"
                    style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0" id="listCats">Categories</h6>
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
                            style="width:140px; height : 60px;">
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{ route('index') }}" class="nav-item nav-link active">Home</a>
                            <a href="" class="nav-item nav-link" data-bs-toggle="modal"
                                data-bs-target="#myModal">Panier</a>
                            <a href="{{ route('about') }}" class="nav-item nav-link">A Propos</a>
                            <a href="{{ route('about') }}" class="nav-item nav-link">Contact</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0">
                            <a href="" class="nav-item nav-link"></a>
                            <a href="" class="nav-item nav-link">Register</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">{{ $category->label }}</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shop Detail</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


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









    <!-- Footer Start -->
    @include('partitions.footer')
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>