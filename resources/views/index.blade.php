<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Store Hassan | Home</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="front/assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="front/css/styles.css" rel="stylesheet" />
    <link href="front/css/bootstrap.min.css" rel="stylesheet" />
    <!-- CDN Font Awesone  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- CDN CSS Bootstrap 5  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- Js to handle the cared -->
    <script>
        let productArray = [];
        let liste = [];

        function itemExists(array, key, value) {
            return array.some(item => item[key] === value);
        }

        // Add an item to the array
        function addToCart(id, productName, price) {
            var currentCardNBR = parseInt(document.getElementById('cardNBR').innerText);
            var newCardNBR = currentCardNBR + 1;
            document.getElementById('cardNBR').innerText = newCardNBR;

            let newItem = {
                id: id,
                product: productName,
                price: price,
                quantity: 1
            };

            // Si le produit existe déjà dans le panier
            if (!itemExists(productArray, 'id', newItem.id)) {
                productArray.push(newItem);
            } else {
                // Trouver l'élément existant dans le panier
                const existingItem = productArray.find(item => item.id === newItem.id);

                // Incrémenter la quantité de l'élément existant
                existingItem.quantity += 1;
            }

            var tableBody = document.getElementById('listProducts');
            var totalAlert = document.getElementById('total');
            var total = 0;

            // Clear existing table body content
            tableBody.innerHTML = '';

            // Populate table body with product data
            productArray.forEach(product => {
                const newRow = document.createElement('tr');

                // Create cells dynamically and set their content
                Object.keys(product).forEach(key => {
                    const cell = document.createElement('td');

                    // If it's the id column, hide it
                    if (key === 'id') {
                        cell.setAttribute('style', 'display:none;');
                    }

                    cell.textContent = product[key];
                    newRow.appendChild(cell);
                });

                // Append the row to the table
                tableBody.appendChild(newRow);
                total += product.quantity * product.price;
            });

            // Clear existing list content
            liste = [];

            // Populate list with product data
            productArray.forEach(product => {
                liste.push(product.id + '_' + product.quantity);
            });

            totalAlert.innerHTML = 'Total à payer : ' + total + ' DH';
            document.getElementById('liste').value = liste.join('_');
        }
    </script>
    <!-- Navigation-->
    <div class="fixed-buttons bg-warning mt-5 rounded-5 ">
        <form class="d-flex ">
            <button class="btn btn-outline-dark">
                <i class="bi-cart-fill me-1"></i>
                Cart
                <span id="cardNBR" class="badge bg-dark text-white ms-1 rounded-pill">0</span>
            </button>
            <button type="button" class="btn btn-light mx-1" data-bs-toggle="modal" data-bs-target="#myModal">
                <i class="fa-regular fa-eye"></i>
            </button>
        </form>
    </div>
    <style>
        .fixed-buttons {
            position: fixed;
            top: 60px;
            right: 0;
            padding: 15px;
            z-index: 1000;
            /* Adjust as needed */
        }
    </style>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">Store Hassan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mr-5 float-end" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="javascript:void(0);" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="#">All Products</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Popular Items</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">New Arrivals</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Header-->
    <header class="container rounded-5 bg-dark ">
        <div id="carouselExampleDark" class="carousel carousel-dark slide text-light">
            <div class="carousel-indicators text-light">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0"
                    class="active text-light" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"
                    class=" text-light"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"
                    class=" text-light"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                    <img src="{{ asset('front/assets/slide/1.jpg') }}" class="d-block w-100 rounded-5" alt="..."
                        height="600">
                    <div class="carousel-caption d-none d-md-block text-light">
                        <h5>First slide label</h5>
                        <p>Some representative placeholder content for the first slide.</p>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="{{ asset('front/assets/slide/2.jpg') }}" class="d-block w-100 rounded-5" alt="..."
                        height="600">
                    <div class="carousel-caption d-none d-md-block text-light">
                        <h5>Second slide label</h5>
                        <p>Some representative placeholder content for the second slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('front/assets/slide/3.jpg') }}" class="d-block w-100 rounded-5" alt="..."
                        height="600">
                    <div class="carousel-caption d-none d-md-block text-light">
                        <h5>Third slide label</h5>
                        <p>Some representative placeholder content for the third slide.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </header>





    <!-- Section-->
    <section class="py-5">

        <!-- Search and Filter  -->
        <div class="container">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-5">
                    <h3 class="py-1 ms-3">Filtrer :</h3>
                </div>
                <div class="col-5">
                    <form id="SearchForm" onsubmit="searchStudents(event)">
                        <div class="input-group">
                            <input type="text" class="form-control" id="searchInput" name="searchInput"
                                placeholder="Entrer">
                            <button class="btn btn-outline-success" type="submit">Chercher</button>
                        </div>
                    </form>
                </div>
                <div class="col-1"></div>
                <script>
                    function searchStudents(event) {
                        event.preventDefault();
                        var searchValue = document.getElementById('searchInput').value.toLowerCase();
                        var rows = document.querySelectorAll('.productNameForSearch');
                        rows.forEach(function (row) {
                            var name = row.textContent.toLowerCase();
                            var gh = row.parentNode.parentNode.parentNode.parentNode
                            if (name.includes(searchValue)) {
                                gh.style.display = '';
                            } else {
                                gh.style.display = 'none';
                            }
                        });
                    }
                </script>
                <div class="col-1"></div>
                <div class="col-10">
                    <form id="filterForm">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="filterCategorie">Catégorie</label>
                            <select class="form-select" id="filterCategorie" name="filterCategorie">
                                <option value="all">Tous</option>
                                <option value="oui">Orphelins</option>
                                <option value="non">Non Orphelins</option>
                            </select>
                            <label class="input-group-text" for="filterPrix">Prix</label>
                            <select class="form-select" id="filterPrix" name="filterPrix">
                                <option value="all">Tous</option>
                                <option value="complet">Complet</option>
                                <option value="demi">Demi</option>
                                <option value="non">Non Boursé</option>
                            </select>
                            <label class="input-group-text" for="filterMostBuy">Plus Achetés</label>
                            <select class="form-select" id="filterMostBuy" name="filterMostBuy">
                                <option value="all">Tous</option>
                                <option value="complet">Complet</option>
                                <option value="demi">Demi</option>
                                <option value="non">Non Boursé</option>
                            </select>
                            <button class="btn btn-outline-success" type="submit">Appliquer</button>
                        </div>
                    </form>
                </div>
                <div class="col-1"></div>
            </div>
        </div>


        <!-- Produits  -->
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center" id="Produits">
                @foreach ($produits as $produit)
                <div class="col mb-5" id="prod_{{ $produit->id.'_'.$produit->id_categorie }}">
                    <div class="card h-100">
                        <div id="carouselExample{{ $produit->id }}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @if ($produit->repPhotos)
                                @php
                                $folderPath = public_path('storage/' . $produit->repPhotos);
                                $imageFiles = File::allFiles($folderPath);
                                @endphp
                                @foreach ($imageFiles as $key => $imageFile)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $produit->repPhotos . '/' . $imageFile->getFilename()) }}"
                                        class="d-block w-100" alt="Product Image" height="180">
                                </div>
                                @endforeach
                                @endif
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExample{{ $produit->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExample{{ $produit->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>

                        <!-- Product details-->
                        <div class="card-body p-2">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder productNameForSearch">{{ $produit->label }}</h5>
                                <!-- Product prices-->
                                <p class="text-danger p-0">{{ $produit->oldPrice }}</p>
                                {{ $produit->price }}
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center justify-content-center align-items-center">
                                <a class="btn btn-primary text-light fw-bold fs-6 btn-outline-dark mt-auto"
                                    onclick="addToCart({{ $produit->id }},'{{ $produit->label }}', {{ $produit->price }})"><i
                                        class="fa-solid fa-cart-shopping"></i></a>
                                <button type="button"
                                    class="btn btn-success text-light fw-bold fs-6 btn-outline-dark mt-auto"
                                    data-bs-toggle="modal" data-bs-target="#detailProdModal">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="detailProdModal" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="titre"></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row justify-content-center align-items-center text-center">
                                                    <div class="col-5">
                                                        <img src="https://s.alicdn.com/@sc04/kf/Hf02070edd0394dcc96c05860cdee240bK.jpg_140x140.jpg"
                                                            alt="Principal Image" id="principalImage"
                                                            class="img-fluid w-100">
                                                        <div class="row">
                                                            <img src="https://s.alicdn.com/@sc04/kf/Hc5fa2de0d4b34818822c18ae9f03da4eq.jpg_140x140.jpg"
                                                                alt="Thumbnail 1" class="img-thumbnail col-4"
                                                                onclick="changeImage('https://s.alicdn.com/@sc04/kf/Hc5fa2de0d4b34818822c18ae9f03da4eq.jpg_140x140.jpg')">
                                                            <img src="https://s.alicdn.com/@sc04/kf/H422d2de3f9fd430d995b06d24ede12c4O.jpg_140x140.jpg"
                                                                alt="Thumbnail 2" class="img-thumbnail col-4"
                                                                onclick="changeImage('https://s.alicdn.com/@sc04/kf/H422d2de3f9fd430d995b06d24ede12c4O.jpg_140x140.jpg')">
                                                            <img src="https://s.alicdn.com/@sc04/kf/H49a0931f8b8348938f9874192bef8ca59.jpg_220x220.jpg"
                                                                alt="Thumbnail 3" class="img-thumbnail col-4"
                                                                onclick="changeImage('https://s.alicdn.com/@sc04/kf/H49a0931f8b8348938f9874192bef8ca59.jpg_220x220.jpg')">
                                                        </div>
                                                    </div>
                                                    <div class="col-7">
                                                        <h2>Product Name</h2>
                                                        <p>Description: This is a fantastic product with great features.
                                                        </p>
                                                        <p>Price: $19.99</p>
                                                        <button class="btn btn-primary">Add to Cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                function changeImage(newImageSrc) {
                                                    // Change the principal image source
                                                    document.getElementById('principalImage').src = newImageSrc;
                                                }
                                            </script>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Understood</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
    </section>
    <!-- Button to Open the Modal -->


    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-center">La Commande </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div id="listeProduits">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Prix</th>
                                    <th>Quantités</th>
                                </tr>
                            </thead>
                            <tbody id="listProducts">
                            </tbody>
                        </table>
                        <div class="alert alert-success" id="total">

                        </div>
                    </div>
                    <div id="formulaire" style="display:none;">
                        <form action="{{ route('addCommande') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="emailAddress">Nom complet :</label>
                                <input class="form-control" id="nomComplet" name="nomComplet" type="email"
                                    placeholder="Nom complet ...." data-sb-validations="required" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="emailAddress">Telephone :</label>
                                <input class="form-control" id="telephone" name="telephone" type="email"
                                    placeholder="Telephone ......" data-sb-validations="required" />
                            </div>
                            <input class="form-control d-none" id="liste" name="listeProduits" type="text"
                                data-sb-validations="required" />
                            <div class="mb-3">
                                <label class="form-label" for="message">Message</label>
                                <textarea class="form-control" id="message" name="message" type="text"
                                    placeholder="Message" style="height: 10rem;"></textarea>
                            </div>

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <span>{{ $error }}</span> <br>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" id="btnFermer" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" id="btnSuivant" class="btn btn-danger" onclick='
                    document.getElementById("listeProduits").style.display="none";
                    document.getElementById("formulaire").style.display="";
                    document.getElementById("btnSuivant").style.display="none";
                    document.getElementById("btnRetourner").style.display="";
                    document.getElementById("btnEnvoyer").style.display="";
                '>Suivant</button>
                    <button type="button" id="btnRetourner" class="btn btn-danger" onclick='
                    document.getElementById("formulaire").style.display="none";
                    document.getElementById("listeProduits").style.display="";
                    document.getElementById("btnSuivant").style.display="";
                    document.getElementById("btnRetourner").style.display="none";
                    document.getElementById("btnEnvoyer").style.display="none";
                ' style="display:none;">Retourner</button>
                    <button type="button" id="btnEnvoyer" class="btn btn-danger" onclick="
                    var form = document.getElementById('formulaire').querySelector('form');
                    form.submit();
                " style="display:none;">Envoyer</button>
                </div>

            </div>
        </div>
    </div>





    <!-- Partners Section  -->
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <div class="container">
        <h2>Our Partners</h2>
        <section class="customer-logos slider">
            @foreach ($partenaires as $partenaire)
            <div class="slide">
                <img src="hhhh">
            </div>
            @endforeach
        </section>
    </div>
    <style>
        h2 {
            text-align: center;
            padding: 20px;
        }

        /* Slider */

        .slick-slide {
            margin: 0px 20px;
        }

        .slick-slide img {
            width: 100%;
        }

        .slick-slider {
            position: relative;
            display: block;
            box-sizing: border-box;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-touch-callout: none;
            -khtml-user-select: none;
            -ms-touch-action: pan-y;
            touch-action: pan-y;
            -webkit-tap-highlight-color: transparent;
        }

        .slick-list {
            position: relative;
            display: block;
            overflow: hidden;
            margin: 0;
            padding: 0;
        }

        .slick-list:focus {
            outline: none;
        }

        .slick-list.dragging {
            cursor: pointer;
            cursor: hand;
        }

        .slick-slider .slick-track,
        .slick-slider .slick-list {
            -webkit-transform: translate3d(0, 0, 0);
            -moz-transform: translate3d(0, 0, 0);
            -ms-transform: translate3d(0, 0, 0);
            -o-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

        .slick-track {
            position: relative;
            top: 0;
            left: 0;
            display: block;
        }

        .slick-track:before,
        .slick-track:after {
            display: table;
            content: '';
        }

        .slick-track:after {
            clear: both;
        }

        .slick-loading .slick-track {
            visibility: hidden;
        }

        .slick-slide {
            display: none;
            float: left;
            height: 100%;
            min-height: 1px;
        }

        [dir='rtl'] .slick-slide {
            float: right;
        }

        .slick-slide img {
            display: block;
        }

        .slick-slide.slick-loading img {
            display: none;
        }

        .slick-slide.dragging img {
            pointer-events: none;
        }

        .slick-initialized .slick-slide {
            display: block;
        }

        .slick-loading .slick-slide {
            visibility: hidden;
        }

        .slick-vertical .slick-slide {
            display: block;
            height: auto;
            border: 1px solid transparent;
        }

        .slick-arrow.slick-hidden {
            display: none;
        }
    </style>
    <script>
        $(document).ready(function () {
            $('.customer-logos').slick({
                slidesToShow: 6,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 1500,
                arrows: false,
                dots: false,
                pauseOnHover: false,
                responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 4
                    }
                }, {
                    breakpoint: 520,
                    settings: {
                        slidesToShow: 3
                    }
                }]
            });
        });
    </script>




    <!-- Section for What clients Say :  -->



    <!-- lazily load the Swiper CSS file -->
    <link rel="preload" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">

    <!-- lazily load the Swiper JS file -->
    <script defer="defer" src="https://unpkg.com/swiper@8/swiper-bundle.min.js"
        onload="initializeSwiperRANDOMID();"></script>

    <!-- lc-needs-hard-refresh -->
    <script>
        function initializeSwiperRANDOMID() {
            // Launch SwiperJS  
            const swiper = new Swiper(".mySwiper-RANDOMID", {
                slidesPerView: 1,
                grabCursor: true,
                spaceBetween: 30,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                },
            });
        }
    </script>

    <div class="container py-6">
        <div class="lc-block text-center">
            <div editable="rich">
                <h2 class="mb-3 display-6 fw-bold">Clients Adorables</h2>
            </div>
        </div>
        <div class="lc-block text-center mb-5">
            <div editable="rich">
                <p class="mb-3 lead">Les clients sont formidables. Découvrez ce que disent nos clients à notre sujet.
                </p>
            </div>
        </div>
        <div class="row align-items-center py-2">
            <div class="position-relative">
                <img src="https://cdn.livecanvas.com/media/svg/fffuel/svg-shape-11.svg" width="256" height="256"
                    srcset="" sizes="" alt="Made by fffuel.com"
                    class="d-none d-xl-block position-absolute top-0 start-0 translate-middle mt wp-image-2412"
                    loading="lazy">
                <!-- Slider main container -->
                <div class="swiper mySwiper-RANDOMID position-relative">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper mb-5">
                        <!-- Slides -->
                        @foreach ($opinions as $opinion)
                        <div class="swiper-slide lc-block">
                            <div class="card p-3">
                                <div class="card-body">
                                    <div class="lc-block mb-4">
                                        <div editable="rich">
                                            <p><em class="rfs-8 text-muted"> {{ $opinion->opinion }}.&nbsp;</em></p>
                                        </div>
                                    </div>
                                    <div class="lc-block d-inline-flex">
                                        <div class="lc-block me-3" style="min-width:72px">
                                            <img class="img-fluid rounded-circle "
                                                src="{{ asset('storage/'.$opinion->photo) }}" width="72" height="72">
                                        </div>
                                        <!-- https://i.pravatar.cc/96?img=6 -->
                                        <div class="lc-block">
                                            <div editable="rich">
                                                <p class="h6 mt-3">{{ $opinion->name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- If we need pagination -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>







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
                            src="https://maps.google.com/maps?width=802&amp;height=416&amp;hl=en&amp;q=ANGLE AVENUE YACOUB EL MANSOUR ET ALLAL EL FASSI IMMEUBLE OUIRIDA 53 ETAGE N° 5 BUREAU 46, Marrakech 40000&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a
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









    <!-- Footer-->
    <section>
        <div class="py-5 container bg-light position-relative rounded">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="lc-block mb-2">
                        <img alt="logo" class="img-fluid" src="https://cdn.livecanvas.com/media/logos/logo-2.svg"
                            style="height:10vh">
                    </div>
                    <div class="lc-block text-dark mb-2">
                        <div editable="rich">
                            <h4>
                                <em>My Company Slogan</em>
                            </h4>
                        </div>
                    </div>
                    <div class="lc-block text-dark text-center">
                        <div editable="rich">
                            <p>Copyright © My Company 2020</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-md-3 d-flex justify-content-center">
                    <div class="lc-block text-center text-dark py-5 mx-2">
                        <a class="text-decoration-none" href="https://www.facebook.com/">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="2em" height="2em"
                                lc-helper="svg-icon" fill="currentColor">
                                <path
                                    d="M400 32H48A48 48 0 0 0 0 80v352a48 48 0 0 0 48 48h137.25V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.27c-30.81 0-40.42 19.12-40.42 38.73V256h68.78l-11 71.69h-57.78V480H400a48 48 0 0 0 48-48V80a48 48 0 0 0-48-48z">
                                </path>
                            </svg>
                        </a>
                    </div>
                    <div class="lc-block text-center text-dark py-5 mx-2">
                        <a class="text-decoration-none" href="https://www.pinterest.com/">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="2em" height="2em"
                                lc-helper="svg-icon" fill="currentColor">
                                <path
                                    d="M448 80v352c0 26.5-21.5 48-48 48H154.4c9.8-16.4 22.4-40 27.4-59.3 3-11.5 15.3-58.4 15.3-58.4 8 15.3 31.4 28.2 56.3 28.2 74.1 0 127.4-68.1 127.4-152.7 0-81.1-66.2-141.8-151.4-141.8-106 0-162.2 71.1-162.2 148.6 0 36 19.2 80.8 49.8 95.1 4.7 2.2 7.1 1.2 8.2-3.3.8-3.4 5-20.1 6.8-27.8.6-2.5.3-4.6-1.7-7-10.1-12.3-18.3-34.9-18.3-56 0-54.2 41-106.6 110.9-106.6 60.3 0 102.6 41.1 102.6 99.9 0 66.4-33.5 112.4-77.2 112.4-24.1 0-42.1-19.9-36.4-44.4 6.9-29.2 20.3-60.7 20.3-81.8 0-53-75.5-45.7-75.5 25 0 21.7 7.3 36.5 7.3 36.5-31.4 132.8-36.1 134.5-29.6 192.6l2.2.8H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48z">
                                </path>
                            </svg>
                        </a>
                    </div>
                    <div class="lc-block text-center text-dark py-5 mx-2">
                        <a class="text-decoration-none" href="https://www.linkedin.com/">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="2em" height="2em"
                                lc-helper="svg-icon" fill="currentColor">
                                <path
                                    d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z">
                                </path>
                            </svg>
                        </a>
                    </div>
                    <div class="lc-block text-center text-dark py-5 mx-2">
                        <a class="text-decoration-none" href="https://www.instagram.com/">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="2em" height="2em"
                                lc-helper="svg-icon" fill="currentColor">
                                <path
                                    d="M224,202.66A53.34,53.34,0,1,0,277.36,256,53.38,53.38,0,0,0,224,202.66Zm124.71-41a54,54,0,0,0-30.41-30.41c-21-8.29-71-6.43-94.3-6.43s-73.25-1.93-94.31,6.43a54,54,0,0,0-30.41,30.41c-8.28,21-6.43,71.05-6.43,94.33S91,329.26,99.32,350.33a54,54,0,0,0,30.41,30.41c21,8.29,71,6.43,94.31,6.43s73.24,1.93,94.3-6.43a54,54,0,0,0,30.41-30.41c8.35-21,6.43-71.05,6.43-94.33S357.1,182.74,348.75,161.67ZM224,338a82,82,0,1,1,82-82A81.9,81.9,0,0,1,224,338Zm85.38-148.3a19.14,19.14,0,1,1,19.13-19.14A19.1,19.1,0,0,1,309.42,189.74ZM400,32H48A48,48,0,0,0,0,80V432a48,48,0,0,0,48,48H400a48,48,0,0,0,48-48V80A48,48,0,0,0,400,32ZM382.88,322c-1.29,25.63-7.14,48.34-25.85,67s-41.4,24.63-67,25.85c-26.41,1.49-105.59,1.49-132,0-25.63-1.29-48.26-7.15-67-25.85s-24.63-41.42-25.85-67c-1.49-26.42-1.49-105.61,0-132,1.29-25.63,7.07-48.34,25.85-67s41.47-24.56,67-25.78c26.41-1.49,105.59-1.49,132,0,25.63,1.29,48.33,7.15,67,25.85s24.63,41.42,25.85,67.05C384.37,216.44,384.37,295.56,382.88,322Z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid" lc-helper="background"
            style="height:30vh;background:url(https://images.unsplash.com/photo-1524260855046-f743b3cdad07?ixlib=rb-1.2.1&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1980&amp;h=768&amp;fit=crop&amp;ixid=eyJhcHBfaWQiOjM3ODR9)  center / cover no-repeat;margin-top:-100px">
        </div>
    </section>



    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="front/js/scripts.js"></script>
    <script src="front/js/bootstrap.min.js"></script>
    <!-- CDN JS Bootstrap 5  -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>