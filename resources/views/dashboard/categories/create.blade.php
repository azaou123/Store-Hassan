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


            <!-- Formulaire d'ajout d'un nouvelle categorie  -->
            <div class="col-sm-12 col-xl-12 mt-4">
                <div class="rounded h-100 p-4 my-2">
                    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h6 class="mb-4">Enter Category Information:</h6>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control bg-light text-dark" name="label" id="floatingInput"
                                placeholder="Category Name" required>
                            <label for="floatingInput" class="text-dark">Nom catégorie</label>
                        </div>
                        <div class="form-floating my-2">
                            <textarea class="form-control bg-light text-dark" name="description"
                                placeholder="Leave a comment here" id="floatingTextarea" style="height: 150px;"
                                required></textarea>
                            <label for="floatingTextarea" class="text-dark">Description de catégorie</label>
                        </div>
                        <div class="my-2">
                            <input type="file" class="form-control bg-light text-dark" name="photos[]" id="photos"
                                multiple required>
                            <label for="photos">Photos</label>
                        </div>
                        <div class="row">
                            <div class="col-3"></div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary w-100">Submit</button>
                            </div>
                            <div class="col-3"></div>
                        </div>
                        @if ($errors->any())
                        <div class="alert alert-danger text-light ">
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