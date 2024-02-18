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
  <title>LuxMar | {{ $produit->label }}</title>
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

  <div class="hero_area">
    <!-- header section strats -->
    @include('partitions.navbar')
    <!-- end header section -->
  </div>

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




  <!-- product section -->







  <section class="py-5">
    @php
    $folderPath = public_path('storage/' . $produit->repPhotos);
    $imageFiles = File::allFiles($folderPath);
    @endphp
    <div class="container">
      <!-- Page title -->
      <div class="row">
        <div class="col-12">
          <div class="page-title-box">
            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">LuxMar</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0);">Produits</a></li>
                <li class="breadcrumb-item active">{{ $produit->label }}</li>
              </ol>
            </div>
            <h4 class="page-title mt-4">Les Détails : </h4>
          </div>
        </div>
      </div>

      <!-- Product details -->
      <div class="row">
        <div class="col-lg-5">
          <!-- Main product image -->
          <a href="javascript: void(0);" class="text-center d-block mb-4">
              <img id="mainProductImage" src="{{ asset('storage/' . $produit->repPhotos . '/' . $imageFiles[0]->getFilename()) }}"
                  class="img-fluid my-4" style="width: 300px; height: 350px;" alt="Product-img">
          </a>
          <!-- Additional product images as thumbnails -->
          <div class="row justify-content-center">
          @foreach($imageFiles as $img)
          @if (in_array(strtolower(pathinfo($img, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png',
                        'gif']))
            <div class="col-3">
              <img src="{{ asset('storage/' . $produit->repPhotos . '/' . $img->getFilename()) }}"
                  alt="Thumbnail {{ $loop->index + 1 }}"
                  class="img-thumbnail thumbnail"
                  style="width: 130px; height: 100px;">
            </div>
            @endif
          @endforeach
          </div>
      </div>

        <div class="col-lg-7">
          <!-- Product details form -->
          <form class="ps-lg-4">
            <h3 class="mt-0">{{ $produit->label }} <a href="javascript: void(0);" class="text-muted"><i
                  class="mdi mdi-square-edit-outline ms-2"></i></a></h3>
            <p class="mb-1">Date d'Ajout : {{ $produit->created_at->format('m/d/Y') }}</p>

            <!-- Rating -->
            <p class="font-16">
              @for ($i = 0; $i < 5; $i++) <span class="text-warning mdi mdi-star"></span>
                @endfor
            </p>

            <!-- Product stock -->
            <div class="mt-3">
              <h4><span class="badge badge-success-lighten">In stock</span></h4>
            </div>

            <!-- Retail Price -->
            <div class="mt-4">
              <h6 class="font-14">Prix :</h6>
              <h3>{{ $produit->price }} DH</h3>
            </div>

            <!-- Quantity -->
            <div class="d-flex">
              <button type="button" onclick="addToCart({{ $produit->id }},'{{ $produit->label }}', {{ $produit->price }})" class="btn btn-danger ms-2">
                <i class="mdi mdi-cart me-1"></i> Ajouter Au Panier
              </button>
            </div>

            <div class="d-flex my-2">
              <a href="{{ asset('storage/' . $produit->fiche_tech) }}" type="button" class="btn btn-success ms-2">
                <i class="mdi mdi-file me-1"></i> Fiche Technique
              </a>
              @if ($produit->fiche_tech)
                <!-- Add download attribute for the Fiche Technique -->
                <a href="{{ asset('storage/' . $produit->fiche_tech) }}" class="btn btn-success ms-2" download>
                  <i class="mdi mdi-file-download me-1"></i> Télécharger Fiche Technique
                </a>
              @endif
            </div>


            <!-- Product description -->
            <div class="mt-4">
              <h6 class="font-14">Description:</h6>
              <p>{{ $produit->description }}</p>
            </div>

            <!-- Product information -->
            <div class="mt-4">
              <div class="row">
                <div class="col-md-4">
                  <h6 class="font-14">Stock:</h6>
                  <p class="text-sm lh-150">{{ $produit->stock }}</p>
                </div>
                <div class="col-md-4">
                  <h6 class="font-14">Ordres:</h6>
                  <p class="text-sm lh-150">{{ $produit->nbrAchats }}</p>
                </div>
                <div class="col-md-4">
                  <h6 class="font-14">Revenue:</h6>
                  <p class="text-sm lh-150">{{ $produit->price * $produit->nbrAchats }} DH</p>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <script>
  document.addEventListener("DOMContentLoaded", function () {
    // Wait for the DOM to be fully loaded before attaching event listeners

    // Function to change the main product image when a thumbnail is clicked
    function changeImage(thumbnail) {
      document.getElementById('mainProductImage').src = thumbnail.src;
    }

    // Attach click event listeners to each thumbnail
    var thumbnails = document.querySelectorAll('.thumbnail');
    thumbnails.forEach(function (thumbnail) {
      thumbnail.addEventListener('click', function () {
        changeImage(thumbnail);
      });
    });
  });

  </script>




  <section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Produits En Relation </h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @if(!empty($categoryProducts))
                @foreach ($categoryProducts as $prod)
                    <div class="col mb-5">
                        <div class="card h-100">
                            @if ($prod->repPhotos)
                                @php
                                    $folderPath = public_path('storage/' . $prod->repPhotos);
                                    $imageFiles = File::allFiles($folderPath);
                                @endphp
                                <!-- Product image from the first file in the directory -->
                                <img class="card-img-top"
                                    src="{{ asset('storage/' . $prod->repPhotos . '/' . $imageFiles[0]->getFilename()) }}"
                                    alt="..." style="height: 250px; object-fit: cover;">
                            @else
                                <!-- Placeholder image when no images are found -->
                                <img class="card-img-top"
                                    src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..."
                                    style="height: 250px;">
                            @endif
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $prod->label }}</h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    <span class="text-muted text-decoration-line-through">{{ $prod->oldPrice }}</span>
                                    <b>{{ $prod->price }}</b>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-primary text-light fw-bold fs-6 btn-outline-dark mt-auto"
                                        onclick="addToCart({{ $prod->id }},'{{ $prod->label }}', {{ $prod->price }})">
                                        <i class="fas fa-cart-plus"></i> <!-- Font Awesome cart icon -->
                                    </a>
                                    <a class="btn btn-success text-light fw-bold fs-6 btn-outline-dark mt-auto"
                                        href="{{ route('produitdetails', ['produit' => $prod->id]) }}">
                                        <i class="fas fa-info-circle"></i> <!-- Font Awesome info icon -->
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            @if(!empty($similarNameProducts))
                @foreach ($similarNameProducts as $prod)
                    <div class="col mb-5">
                        <div class="card h-100">
                            @if ($prod->repPhotos)
                                @php
                                    $folderPath = public_path('storage/' . $prod->repPhotos);
                                    $imageFiles = File::allFiles($folderPath);
                                @endphp
                                <!-- Product image from the first file in the directory -->
                                <img class="card-img-top"
                                    src="{{ asset('storage/' . $prod->repPhotos . '/' . $imageFiles[0]->getFilename()) }}"
                                    alt="..." style="height: 250px; object-fit: cover;">
                            @else
                                <!-- Placeholder image when no images are found -->
                                <img class="card-img-top"
                                    src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..."
                                    style="height: 250px;">
                            @endif
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $prod->label }}</h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    <span class="text-muted text-decoration-line-through">{{ $prod->oldPrice }}</span>
                                    <b>{{ $prod->price }}</b>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-primary text-light fw-bold fs-6 btn-outline-dark mt-auto"
                                        onclick="addToCart({{ $prod->id }},'{{ $prod->label }}', {{ $prod->price }})">
                                        <i class="fas fa-cart-plus"></i> <!-- Font Awesome cart icon -->
                                    </a>
                                    <a class="btn btn-success text-light fw-bold fs-6 btn-outline-dark mt-auto"
                                        href="{{ route('produitdetails', ['produit' => $prod->id]) }}">
                                        <i class="fas fa-info-circle"></i> <!-- Font Awesome info icon -->
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>


  <!-- end product section -->



  <!-- footer section -->
  @include('partitions.footer')

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