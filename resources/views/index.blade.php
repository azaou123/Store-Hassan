<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <link rel="shortcut icon" href="{{asset('fav.png')}}" type="image/x-icon">
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>LuxMar</title>


  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="front/css/bootstrap.css" />
  <link rel="stylesheet" href="front/css/bootstrap.min.css">
  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- range slider -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="shortcut icon" href="{{asset('fav.png')}}" type="image/x-icon">
  <!-- font awesome style -->
  <link href="front/css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="front/css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="front/css/responsive.css" rel="stylesheet" />

</head>

<body style="overflow:scroll;">

  <div class="hero_area">
    <!-- header section strats -->
    @include('partitions.navbar')
    <!-- end header section -->
    <!-- slider section -->
    <!-- Js to handle the cared -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
      integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
      integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
      </script>



    <!-- Navigation-->
    <div class="fixed-buttons bg-warning mt-5 rounded-5">
      <form class="d-flex">
        <button class="btn btn-outline-dark" onclick="showCart()">
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
                  <textarea class="form-control" id="message" name="message" type="text" placeholder="Message"
                    style="height: 10rem;"></textarea>
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
                    document.getElementById('liste').value = liste.join('_')
                    var form = document.getElementById('formulaire').querySelector('form');
                    form.submit();
                " style="display:none;">Envoyer</button>
          </div>

        </div>
      </div>
    </div>
    <section class="slider_section">
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container">
              <div class="row">
                <div class="col-md-6">
                  <div class="detail-box">
                    <h1>
                      Bienvenue dans notre boutique
                    </h1>
                    <p>
                      Découvrez notre boutique en ligne spécialisée dans les matériaux électriques. Trouvez tout ce dont
                      vous avez besoin pour vos projets électriques avec facilité et qualité.
                    </p>
                    <a href="{{ route('index') }}">
                      Commander
                    </a>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="front/images/slider-img.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
    <!-- end slider section -->

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


    <!-- Section-->
    <section class="py-5">
      <!-- Search and Filter  -->
      <div class="container">
        <div class="row">
          <div class="col-1"></div>
          <div class="col-10">
            <form id="SearchForm">
              <div class="input-group">
                <input type="text" class="form-control" id="searchInput" name="searchInput" placeholder="Chercher">
                <button class="btn btn-outline-success" type="button" onclick="searchProduits()">Chercher</button>
              </div>
            </form>
          </div>
          <div class="col-1"></div>
          <br>
          <br>
          <div class="col-1"></div>
          <div class="col-10">
            <form id="filterForm">
              <div class="input-group mb-3">
                <select class="form-select" id="filterCategorie" name="filterCategorie">
                  <option value="all">Tous</option>
                  @foreach ($categories as $cat)
                  <option value="{{ $cat->id }}">{{ $cat->label }}</option>
                  @endforeach
                </select>
                <button class="btn btn-outline-success" type="button" onclick="filtrerProduits()">Appliquer</button>
              </div>
            </form>
          </div>
          <div class="col-1"></div>
        </div>
      </div>

      <script>
        function filtrerProduits() {
          var category = $('#filterCategorie').val();
          $.ajax({
            type: 'GET',
            url: '/filter', // Update this with your actual filter endpoint
            data: { filterCategorie: category },
            dataType: 'json',
            success: function (response) {
              var filteredResults = response.filteredResults;
              $('#productContainer').html(renderSearchResults(filteredResults));
            },
            error: function (error) {
              console.error(error);
            }
          });
        }
        function searchProduits() {
          var searchTerm = $('#searchInput').val();

          // Make an AJAX request
          $.ajax({
            type: 'GET',
            url: '/search', // Update this with your actual search endpoint
            data: { searchInput: searchTerm },
            dataType: 'json', // Specify that you expect JSON data
            success: function (response) {
              var searchResults = response.searchResults;
              // Update the product container with the new results
              $('#productContainer').html(renderSearchResults(searchResults));
            },
            error: function (error) {
              console.error(error);
            }
          });
        }
        function renderSearchResults(results) {
          var container = document.getElementById('productContainer');
          container.innerHTML = ''; // Clear previous results

          if (results.length === 0) {
            container.innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                    <strong>No results found!</strong> Please try a different search term.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
          }

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
            spanOldPrice.className = 'text-muted text-decoration-line-through'; spanOldPrice.textContent = result.oldPrice;
            var spanPrice = document.createElement('b'); spanPrice.textContent = result.price;
            var cardFooter = document.createElement('div');
            cardFooter.className = 'card-footer p-4 pt-0 border-top-0 bg-transparent';
            var textCenterFooter = document.createElement('div'); textCenterFooter.className = 'text-center';
            var btnAddToCart = document.createElement('a');
            btnAddToCart.className = 'btn btn-primary text-light fw-bold fs-6 btn-outline-dark mt-auto mx-1';
            btnAddToCart.onclick = function () { addToCart(result.id, result.label, result.price); };
            btnAddToCart.innerHTML = '<i class="fas fa-cart-plus"></i>'; var btnInfo = document.createElement('a');
            btnInfo.className = 'btn btn-success text-light fw-bold fs-6 btn-outline-dark mt-auto mx-1';
            // btnInfo.href = '{{ route('produitdetails', ['produit'=> ' + result.id + ']) }}';
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
                src="{{ asset('storage/' . $produit->repPhotos . '/' . $imageFiles[0]->getFilename()) }}" alt="..."
                style="height: 250px; object-fit: cover;">
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
    </section>
    <!-- Button to Open the Modal -->


    <!-- why us section -->

    <section class="section_pourquoi_nous layout_padding">
      <div class="container">
        <div class="heading_container heading_center">
          <h2>
            Pourquoi Nous !
          </h2>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="box">
              <div class="img-box">
                <img src="images/w1.png" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  Livraison Rapide
                </h5>
                <p>
                  Variations du passage de Lorem Ipsum disponibles
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="box">
              <div class="img-box">
                <img src="images/w2.png" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  Sercices
                </h5>
                <p>
                  Variations du services et produits poue n'importe quel projet ...
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="box">
              <div class="img-box">
                <img src="images/w3.png" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  Meilleure Qualité
                </h5>
                <p>
                  Variations du passage de Lorem Ipsum disponibles
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end why us section -->


    <!-- Partners Section  -->
    <section id="clients" class="section-bg">

      <div class="container">

        <div class="section-header">
          <h3>Notre Partenaires</h3>
          <p>Confiance en Nous</p>
        </div>
        <div class="row no-gutters clients-wrap clearfix wow fadeInUp"
          style="visibility: visible; animation-name: fadeInUp;">
          @foreach ($partenaires as $part)
          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo">
              <img src="{{ asset('storage/'.$part->logo) }}" class="img-fluid" alt="">
            </div>
          </div>
          @endforeach
        </div>

      </div>

    </section>

    <style>
      .section-header h3 {
        font-size: 36px;
        color: #283d50;
        text-align: center;
        font-weight: 500;
        position: relative;
      }

      .section-header p {
        text-align: center;
        margin: auto;
        font-size: 15px;
        padding-bottom: 60px;
        color: #556877;
        width: 50%;
      }

      #clients {
        padding: 60px 0;

      }

      #clients .clients-wrap {
        border-left: 1px solid #d6eaff;
        margin-bottom: 30px;
      }

      #clients .client-logo {
        padding: 64px;
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -webkit-justify-content: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
        border-right: 1px solid #d6eaff;
        border-bottom: 1px solid #d6eaff;
        overflow: hidden;
        background: #fff;
        height: 160px;
      }

      #clients img {
        transition: all 0.4s ease-in-out;
      }
    </style>


    <!-- client section -->

    <section class="client_section layout_padding-bottom">
      <div class="container">
        <div class="heading_container heading_center">
          <h2>
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
                      <img src="{{ asset('storage/'.$testimonial->photo) }}" alt="{{ $testimonial->name }}"
                        style="width:50px; height:50px;">
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

    <!-- info section -->

    <!-- footer section -->
    @include('partitions.footer')

    <!-- jQery -->
    <script src="front/js/jquery-3.4.1.min.js"></script>
    <!-- bootstrap js -->
    <script src="front/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="front/js/custom.js"></script>
    <script src="front/css/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



</body>

</html>