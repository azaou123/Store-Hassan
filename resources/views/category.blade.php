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
                @include('partitions.subnavbar')
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">{{ $category->label }}</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('index') }}">Accueil</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Selectionner</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Section-->
    <section class="py-1">
        <!-- Search and Filter  -->
        <div class="container">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <form id="SearchForm">
                        <div class="input-group">
                            <input type="text" class="form-control" id="searchInput" name="searchInput"
                                placeholder="Chercher">
                            <button class="btn btn-outline-success" type="button"
                                onclick="searchProduits()">Chercher</button>
                        </div>
                    </form>
                </div>
                <div class="col-1"></div>
            </div>
        </div>

        <script>
            function searchProduits() {
                var searchTerm = $('#searchInput').val();

                // Make an AJAX request
                $.ajax({
                    type: 'GET',
                    url: '/search', // Update this with your actual search endpoint
                    data: { searchInput: searchTerm, cat: {{ $category-> id}} },
            dataType: 'json', // Specify that you expect JSON data
                success: function (response) {
                    var searchResults = response.searchResults;
                    var searchResultsPrime = response.searchResultsPrime;
                    // Update the product container with the new results
                    if (searchResults.length > 0) {
                        $('#productContainer').html(renderSearchResults(searchResults, 'productContainer'));
                    }
                    if (searchResultsPrime.length > 0) {
                        $('#otherCat').html(renderSearchResults(searchResultsPrime, 'otherCat'));
                    }
                    if (searchResults.length == 0 && searchResultsPrime.length == 0) {
                        var container = document.getElementById('productContainer');
                        var container2 = document.getElementById('otherCat');
                        container.innerHTML = ''; // Clear previous results
                        container2.innerHTML = ''; // Clear previous results
                        container.innerHTML = `
                            <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                                <strong>Pas De Résultats !!</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
                            </div>
                        `;
                    }
                },
            error: function (error) {
                console.error(error);
            }
                });
            }
            function renderSearchResults(results, iddiv) {
                var container = document.getElementById(iddiv);
                container.innerHTML = ''; // Clear previous results

                for (var i = 0; i < results.length; i++) {
                    var result = results[i];
                    var col = document.createElement('div');
                    col.className = 'col mb-5';

                    var card = document.createElement('div');
                    card.className = 'card h-100';

                    var img = document.createElement('img');
                    img.className = 'card-img-top';
                    img.alt = '...';
                    img.style.height = '300px';
                    img.style.objectFit = 'cover';
                    var decodedFirstImage = JSON.parse('"' + result.firstImage + '"');
                    img.src = decodedFirstImage;

                    var cardBody = document.createElement('div');
                    cardBody.className = 'card-body p-4';

                    var textCenter = document.createElement('div');
                    textCenter.className = 'text-center';

                    var h5 = document.createElement('h5');
                    h5.className = 'fw-bolder';
                    h5.textContent = result.label;

                    var small = document.createElement('div');
                    small.className = 'd-flex justify-content-center small text-warning mb-2';
                    for (var j = 0; j < 5; j++) {
                        var star = document.createElement('div'); star.className = 'bi-star-fill';
                        small.appendChild(star);
                    }
                    var spanOldPrice = document.createElement('span');
                    spanOldPrice.className = 'text-muted text-danger text-decoration-line-through mx-2'; spanOldPrice.textContent = result.oldPrice;
                    var spanPrice = document.createElement('b'); spanPrice.textContent = result.price;
                    var cardFooter = document.createElement('div');
                    cardFooter.className = 'card-footer p-4 pt-0 border-top-0 bg-transparent';
                    var textCenterFooter = document.createElement('div'); textCenterFooter.className = 'text-center';
                    var btnAddToCart = document.createElement('a');
                    btnAddToCart.className = 'btn btn-primary text-light fw-bold fs-6 btn-outline-dark mt-auto mx-1';
                    btnAddToCart.onclick = function () { addToCart(result.id, result.label, result.price); };
                    btnAddToCart.innerHTML = '<i class="fas fa-cart-plus"></i>'; var btnInfo = document.createElement('a');
                    btnInfo.className = 'btn btn-success text-light fw-bold fs-6 btn-outline-dark mt-auto mx-1';
                    var url = '{{ route("produitdetails", ":id") }}';
                    url = url.replace(':id', result.id);
                    btnInfo.href = url;
                    btnInfo.innerHTML = '<i class="fas fa-info-circle"></i>';

                    textCenterFooter.appendChild(btnAddToCart);
                    textCenterFooter.appendChild(btnInfo);

                    textCenter.appendChild(h5);
                    textCenter.appendChild(small);
                    textCenter.appendChild(spanOldPrice);
                    textCenter.appendChild(spanPrice);

                    cardBody.appendChild(textCenter);
                    cardFooter.appendChild(textCenterFooter);

                    card.appendChild(img);
                    card.appendChild(cardBody);
                    card.appendChild(cardFooter);

                    col.appendChild(card);

                    container.appendChild(col);
                }
            }
        </script>






        <div class="container px-4 px-lg-5 mt-5">
            <div id="productContainer"
                class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-xl-4 justify-content-center">
                @foreach ($produits as $produit)
                <div class="col mb-5">
                    <div class="card h-100">
                        @if ($produit->repPhotos)
                        @php
                        $folderPath = public_path('storage/' . $produit->repPhotos);
                        $imageFiles = File::allFiles($folderPath);
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
            <hr>
            <div class="container">
                <div id="otherCat"
                    class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-xl-4 justify-content-center">
                </div>
            </div>
    </section>
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