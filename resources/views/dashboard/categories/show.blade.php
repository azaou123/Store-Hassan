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
    <link href="{{asset ('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{asset ('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset ('back/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset ('back/css/style.css') }}" rel="stylesheet">
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
            <!-- Navbar End -->


            <!-- Section Pour voir Les Détails d'un Telle Catégorie  -->
            <!-- Section Pour voir Les Détails d'un Telle Catégorie -->
            @php
            $folderPath = public_path('storage/'.$category->repPhotos);
            $imageFiles = File::allFiles($folderPath);
            @endphp

            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card bg-secondary">
                            <div class="card-body">
                                <h4 class="fw-bold display-4 text-center">{{ $category->label }}</h4>
                                <div class="row mt-4">
                                    <div class="col-2"></div>
                                    <div class="col-md-8">
                                        <img class="img-fluid rounded-5"
                                            src="{{ asset('storage/' . $category->repPhotos . '/' . $imageFiles[0]->getFilename()) }}"
                                            style="" alt="Category Photo" loading="lazy">
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <p class="lead">{{ $category->description }}</p>
                                </div>
                                <div class="mt-5">
                                    <div class="lc-block">
                                        <form method="post" action="{{ route('categories.update', $category->id) }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')
                                            <div class="mb-3">
                                                <label for="label" class="form-label">Label:</label>
                                                <input type="text" name="label" id="label"
                                                    value="{{ $category->label }}" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description:</label>
                                                <textarea name="description" id="description" class="form-control"
                                                    required>{{ $category->description }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="categoryPhotos" class="form-label">Update Photos:</label>
                                                <input type="file" name="categoryPhotos[]" id="categoryPhotos"
                                                    class="form-control-file" multiple>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>






                <!-- Footer Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-secondary rounded-top p-4">
                        <div class="row">
                            <div class="col-12 col-sm-6 text-center text-sm-start text-center">
                                &copy; <a href="#">Luxmar Maroc 2024</a>, Tous Les Droits Sont Réservés.
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