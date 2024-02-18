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
  <link href="{{ asset('front/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
  <!-- Customized Bootstrap Stylesheet -->
  <link href="{{ asset('front/css/style.css') }}" rel="stylesheet">


</head>

<body class="sub_page">

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
          data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
          <h6 class="m-0">Categories</h6>
          <i class="fa fa-angle-down text-dark"></i>
        </a>
        <nav
          class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0"
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
              <a href="" class="nav-item nav-link" data-bs-toggle="modal" data-bs-target="#myModal">Panier</a>
              <a href="{{ route('about') }}" class="nav-item nav-link">A Propos</a>
              <a href="{{ route('about') }}" class="nav-item nav-link">Contact</a>
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
                src="{{ asset('storage/' . $cat->repPhotos . '/' . $imageFiles[0]->getFilename()) }}" alt="Image">
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
      <div class="col-6">
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
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('front/lib/easing/easing.min.js') }}"></script>
  <script src="{{ asset('front/lib/owlcarousel/owl.carousel.min.js') }}"></script>

  <!-- Contact Javascript File -->
  <script src="{{ asset('front/mail/jqBootstrapValidation.min.js') }}"></script>
  <script src="{{ asset('front/mail/contact.js') }}"></script>

  <!-- Template Javascript -->
  <script src="{{ asset('front/js/main.js') }}"></script>



</body>

</html>