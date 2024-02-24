<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DarkPan - Bootstrap 5 Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="back/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('back/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('back/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        @if(Session::has('manager'))
        @php
        $manager = Session::get('manager')
        @endphp
        @endif
        <!-- Sidebar Start -->
        @include('dashboard.sidebar')
        <div class="content">
            <!-- Navbar Start -->
            @include('dashboard.navbar')

            <div class="container py-5">
                <h4 class="fw-bold">{{ $produit->label }} - Edit</h4>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <form method="post" action="{{ route('produits.update', $produit->id) }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Label -->
                    <input type="hidden" name="id" value="{{ $produit->id }}">
                    <div class="mb-3">
                        <label for="label" class="form-label">Label</label>
                        <input type="text" class="form-control bg-light text-dark" id="label" name="label"
                            value="{{ $produit->label }}" required>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control bg-light text-dark" id="description" name="description" rows="4"
                            required>{{ $produit->description }}</textarea>
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control bg-light text-dark" id="price" name="price"
                            value="{{ $produit->price }}" required>
                    </div>

                    <!-- Old Price -->
                    <div class="mb-3">
                        <label for="oldPrice" class="form-label">Old Price</label>
                        <input type="number" class="form-control bg-light text-dark" id="oldPrice" name="oldPrice"
                            value="{{ $produit->oldPrice }}">
                    </div>

                    <!-- Number of Purchases -->
                    <div class="mb-3">
                        <label for="nbrAchats" class="form-label">Number of Purchases</label>
                        <input type="number" class="form-control bg-light text-dark" id="nbrAchats" name="nbrAchats"
                            value="{{ $produit->nbrAchats }}" required>
                    </div>

                    <!-- Category Selection -->
                    <div class="mb-3">
                        <label for="id_categorie" class="form-label">Category</label>
                        <select class="form-select bg-light text-dark" id="id_categorie" name="id_categorie" required>
                            <!-- Iterate over categories and select the one associated with the product -->
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ ($category->id == $produit->id_categorie) ?
                                'selected' : '' }}>
                                {{ $category->label }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- File Input for Photos -->
                    <div class="mb-3">
                        <label for="photos" class="form-label">Update Photos</label>
                        <input type="file" class="form-control bg-light text-dark" name="productPhotos[]" multiple>
                    </div>

                    <div class="mb-3">
                        <label for="fiche_tech" class="form-label">Fiche Technique (Optional)</label>
                        <input type="file" class="form-control bg-light text-dark" name="fiche_tech">
                    </div>



                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </form>

                <!-- Existing Photos -->
                @php
                $folderPath = public_path('storage/' . $produit->repPhotos);
                $imageFiles = File::allFiles($folderPath);
                $i = 1;
                @endphp

                @if ($produit->fiche_tech)
                <div class="container py-3">
                    <h5 class="fw-bold">Fiche Technique</h5>
                    <!-- Display the fiche_tech here -->
                    <embed src="{{ asset('storage/' . $produit->fiche_tech) }}" type="application/pdf" width="100%"
                        height="600px" />
                    <!-- Button to delete fiche_tech -->
                    <form action="{{ route('delete.ficheTechnique') }}" method="post">
                        @csrf
                        <input type="hidden" name="idp" id="idp" value="{{ $produit->id }}">
                        <button class="btn btn-danger btn-sm mt-2"
                            onclick="return confirm('Supprimer Fiche Technique ?');">
                            <i class="bi bi-trash"></i> Supprimer Fiche Technique</button>
                        </a>
                    </form>

                </div>
                @endif
                <form action="{{ route('ajouterPhoto') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="idp" value="{{ $produit->id }}">
                    <h3>
                        Ajouter Une Photo au produit:
                    </h3>
                    <input type="file" name="photo" id="photo" class="form-control my-2" required>
                    <button type="submit" class="btn btn-danger btn-sm mt-2">
                        <i class="bi bi-trash"></i> Ajouter
                    </button>
                </form>
                <div class="mb-3">
                    <h4 class="my-2">Les Photos : </h4>
                    <div class="row">
                        @foreach($imageFiles as $imageFile)
                        @if (in_array(strtolower(pathinfo($imageFile, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png',
                        'gif']))
                        <div class="col-md-3 mb-3">
                            <img src="{{ asset('storage/' . $produit->repPhotos . '/' . basename($imageFile)) }}"
                                class="img-fluid rounded" alt="Product Photo" style="width:250px; height:200px;">
                            <a class="btn btn-danger btn-sm mt-2"
                                onclick="deletePhoto(<?php echo $produit->id.','.$i ; ?>)">
                                <i class="bi bi-trash"></i> Delete
                            </a>
                        </div>
                        @php
                        $i++;
                        @endphp
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <form action="{{ route('deletePhoto') }}" method="post" style="display:none;" id="formDeletePhoto">
                @csrf
                <input type="text" id="idProd" name="idProd" value="">
                <input type="text" id="orderPhoto" name="orderPhoto" value="">
            </form>

            <script>
                function deletePhoto(id, i) {
                    document.getElementById('idProd').value = id;
                    document.getElementById('orderPhoto').value = i;
                    document.getElementById('formDeletePhoto').submit();
                }
            </script>








            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start text-center">
                            &copy; <a href="#">Luxmar Maroc 2024</a>, All Right Reserved.
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('back/lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('back/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('back/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('back/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('back/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('back/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('back/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('back/js/main.js') }}"></script>
</body>

</html>