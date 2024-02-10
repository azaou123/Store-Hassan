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
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="back/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="back/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- CDN Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <h4 class="mb-0">Les Paramètres de site web</h4>
                    <hr>
                    <!-- Display current parameter values -->
                    <div class="mb-4">
                        <img src="{{ asset('storage/'.$parametres->logo) }}" alt="Logo" class="img-fluid rounded mb-2"
                            style="width:400ps; height : 150px;">
                        <!-- Add more fields as needed -->
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <!-- Form for editing parametres -->
                    <form action="{{ route('parametres.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Add input fields for editing -->
                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo:</label>
                            <input type="file" name="logo" value="{{ $parametres->logo }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="facebook" class="form-label">Facebook:</label>
                            <input type="text" name="facebook" value="{{ $parametres->facebook }}" class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="twitter" class="form-label">Twitter:</label>
                            <input type="text" name="twitter" value="{{ $parametres->twitter }}" class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="twitter" class="form-label">Email : </label>
                            <input type="text" name="email" value="{{ $parametres->email }}" class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="twitter" class="form-label">Instagram : </label>
                            <input type="text" name="insta" value="{{ $parametres->insta }}" class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="twitter" class="form-label">WhatsApp : </label>
                            <input type="text" name="whatsapp" value="{{ $parametres->whatsapp }}" c
                                class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="twitter" class="form-label">Addresse : </label>
                            <input type="text" name="address" value="{{ $parametres->address }}" c class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="twitter" class="form-label">Google Maps : </label>
                            <input type="text" name="googlemaps" value="{{ $parametres->googlemaps }}" c
                                class="form-control" required>
                        </div>
                        <!-- Add more input fields as needed -->
                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                    </form>

                    <h4 class="mt-5">Le Proprétaire de Site</h4>
                    <hr>
                    <form action="{{ route('manager.update', $manager->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="fullName" class="form-label">Nom & Prénom</label>
                            <input type="text" class="form-control" id="fullName" name="fullName"
                                value="{{ $manager->fullName }}">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $manager->email }}">
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Téléphone</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="{{ $manager->phone }}">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Nouveau Mot De Passe</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                    </form>
                </div>


            </div>
            <!-- Recent Sales End -->

            <!-- Recent Sales End -->



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
    <script src="back/lib/chart/chart.min.js"></script>
    <script src="back/lib/easing/easing.min.js"></script>
    <script src="back/lib/waypoints/waypoints.min.js"></script>
    <script src="back/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="back/lib/tempusdominus/js/moment.min.js"></script>
    <script src="back/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="back/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="back/js/main.js"></script>
</body>

</html>