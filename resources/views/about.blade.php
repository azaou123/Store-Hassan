<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <link rel="icon" href="images/fevicon.png" type="image/gif" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="{{asset('fav.png')}}" type="image/x-icon">
  <title>Luxmar | A propos</title>
  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('front/css/bootstrap.css') }}" />
  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <!-- range slider -->
  <!-- font awesome style -->
  <link href="{{ asset('front/css/font-awesome.min.css') }}" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <!-- Custom styles for this template -->
  <link href="{{ asset('front/css/style.css') }}" rel="stylesheet" />
  <!-- responsive style -->
  <link href="{{ asset('front/css/responsive.css') }}" rel="stylesheet" />

</head>

<body class="sub_page">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <script>
    function loadFromLocalStorage() {
      const savedProductArray = localStorage.getItem('productArray');
      if (savedProductArray) {
        productArray = JSON.parse(savedProductArray);
        for (let i = 0; i < productArray.length; i++) {
          let prod = productArray[i];
          addToCart(prod.id, prod.produit, prod.price);
        }
      }
    }
  </script>

  <div class="hero_area">
    <!-- header section strats -->
    @include('partitions.navbar')
    <!-- end header section -->
  </div>




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
                <input class="form-control" id="telephone" name="telephone" type="email" placeholder="Telephone ......"
                  data-sb-validations="required" />
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
  @if(session('successCommande'))
  <script>    / Show alert with z-index 2
     rt('La Commande Est Envoyé Avec succès, Merci !');
       Storage.clear();
    /    te the session variable after 5 seconds
    set    t(function () {
      @ph      sessi      forget('successCommande');
      @endphp      5000);
  </script>
  @endif

  <!-- about section -->

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
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste quam velit saepe dolorem deserunt
                    quo quidem ad optio.
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


  <div class="container marketing">
    <div class="row text-center ">
      <div class="col-lg-4"></div>
      <div class="col-lg-4">
        <img src="{{ asset('front/images/client.jpg') }}" alt="Photo d'Omar" class="img-fluid rounded-circle my-2">
        <h2 class="fw-normal">Omar dit bonjour aux clients !</h2>
        <p>Bienvenue sur notre Store ! Si vous avez des questions ou avez besoin d'aide, n'hésitez pas à nous
          contacter.
          Nous sommes là pour vous aider !</p>
      </div>
      <div class="col-lg-4"></div>
    </div>
  </div>


  <!-- info section -->
  <section class="client_section layout_padding-bottom mt-3">
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
            <label for="message" class="form-label">Votre Message</label>
            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
      </div>
    </div>
  </section>

  <!-- info section -->

  <!-- footer section -->
  @include('partitions.footer')

  <!-- end info_section -->
  <!-- jQery -->
  <script src="{{ asset('front/js/jquery-3.4.1.min.js') }}"></script>
  <!-- bootstrap js -->
  <script src="{{ asset('front/js/bootstrap.js') }}"></script>
  <!-- custom js -->
  <!-- custom js -->
  <script src="{{ asset('front/js/custom.js') }}"></script>
  <script src="{{ asset('front/css/bootstrap.min.js') }}"></script>



</body>

</html>