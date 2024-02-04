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


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>StoreDrog</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="back/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Jhon Doe</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="{{ route('dashboord') }}" class="nav-item nav-link"><i
                            class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="{{ route('commandes') }}" class="nav-item nav-link"><i
                            class="fas fa-list-alt me-2"></i>Commandes</a>
                    <a href="{{ route('categories') }}" class="nav-item nav-link"><i
                            class="fas fa-folder me-2"></i>Catégoies</a>
                    <a href="{{ route('produits') }}" class="nav-item nav-link active"><i
                            class="fas fa-shopping-cart me-2"></i>Produits</a>
                    <a href="{{ route('opinions') }}" class="nav-item nav-link"><i
                            class="fas fa-comments me-2"></i>Opinions</a>
                    <a href="{{ route('parametres') }}" class="nav-item nav-link"><i
                            class="fas fa-cogs me-2"></i>Paramètres</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="back/img/user.jpg" alt=""
                                        style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="back/img/user.jpg" alt=""
                                        style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="back/img/user.jpg" alt=""
                                        style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="back/img/user.jpg" alt=""
                                style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">John Doe</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


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



                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>

                <!-- Existing Photos -->
                @php
                $folderPath = public_path('storage/'.$produit->repPhotos);
                $imageFiles = File::allFiles($folderPath);
                $i=1;
                @endphp
                <div class="mb-3">
                    <label>Existing Photos</label>
                    <div class="row">
                        @foreach($imageFiles as $imageFile)
                        <div class="col-md-3 mb-3">
                            <img src="{{ asset('storage/' . $produit->repPhotos . '/' . $imageFile->getFilename()) }}"
                                class="img-fluid rounded" alt="Product Photo" style="width:250px; height:200px;">
                            <a class="btn btn-danger btn-sm mt-2"
                                onclick="deletePhoto(<?php echo $produit->id.','.$i ; ?>)">
                                <i class="bi bi-trash"></i> Delete
                            </a>
                        </div>
                        @php
                        $i++;
                        @endphp
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
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Your Site Name</a>, All Right Reserved.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                            <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
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