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
</head>

<body>
    <script>
        function showProducts(listeProduits, a, b, c) {
            // Clear the previous content
            document.getElementById('a').innerText = a;
            document.getElementById('b').innerText = b;
            document.getElementById('c').innerText = c;
            document.getElementById('listProducts').innerHTML = '';
            document.getElementById('total').innerText = '0';

            var modal = document.getElementById('productModal');
            var listProducts = document.getElementById('listProducts');
            modal.style.display = 'block';

            // Split the string into an array
            var productList = listeProduits.split('_');

            let produits = @json($produits);

            function getProductById(id) {
                for (var i = 0; i < produits.length; i++) {
                    if (produits[i].id == id) {
                        return produits[i];
                    }
                }
                return null;
            }

            function createTr(p1, p2, p3) {
                const newRow = document.createElement('tr');
                const cell1 = document.createElement('td');
                const cell2 = document.createElement('td');
                const cell3 = document.createElement('td');
                cell1.innerText = p1;
                cell2.innerText = p2;
                cell3.innerText = p3;
                newRow.appendChild(cell1);
                newRow.appendChild(cell2);
                newRow.appendChild(cell3);
                listProducts.appendChild(newRow);
                document.getElementById('total').innerText = (parseFloat(document.getElementById('total').innerText) + p2 * p3).toFixed(2);
            }

            for (var i = 0; i < productList.length - 1; i = i + 2) {
                var productId = productList[i];
                var product = getProductById(productId);
                if (product) {
                    createTr(product.label, product.price, productList[i + 1]);
                }
            }
        }

        // Close the modal when the close button is clicked
        function closeModal() {
            var modal = document.getElementById('productModal');
            modal.style.display = 'none';
        }

        // Close the modal if the user clicks outside of it
        window.onclick = function (event) {
            var modal = document.getElementById('productModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        };

        document.getElementById('filterStatut').addEventListener('change', function () {
            var selectedStatut = this.value.toLowerCase();
            var commands = document.querySelectorAll('.command-row');

            commands.forEach(function (command) {
                var statut = command.dataset.statut.toLowerCase();

                if (selectedStatut === 'all' || statut === selectedStatut) {
                    command.style.display = 'table-row';
                } else {
                    command.style.display = 'none';
                }
            });
        });
    </script>

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
                    <a href="{{ route('profile') }}" class="nav-item nav-link"><i
                            class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="{{ route('commandes') }}" class="nav-item nav-link active"><i
                            class="fas fa-list-alt me-2"></i>Commandes</a>
                    <a href="{{ route('categories') }}" class="nav-item nav-link"><i
                            class="fas fa-folder me-2"></i>Catégoies</a>
                    <a href="{{ route('produits') }}" class="nav-item nav-link"><i
                            class="fas fa-shopping-cart me-2"></i>Produits</a>
                    <a href="{{ route('opinions') }}" class="nav-item nav-link"><i
                            class="fas fa-comments me-2"></i>Opinions</a>
                    <a href="{{ route('opinions') }}" class="nav-item nav-link"><i
                            class="fa-solid fa-handshake"></i></i>Partenaires</a>
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


            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Les Commandes</h6>
                        <div class="mb-3">
                            <label for="filterStatut" class="form-label">Filtrer : </label>
                            <select class="form-select" id="filterStatut">
                                <option value="all">Tous</option>
                                <option value="Envoyée">Envoyée</option>
                                <option value="Validée">Validée</option>
                                <option value="Supprimée">Supprimée</option>
                            </select>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div id="productModal" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeModal()">&times;</span>
                            <h2 class="text-dark">Le Client : </h2>
                            <div class="container">
                                <p>Nom Complet : <strong id="a"></strong></p>
                                <p>Téléphone : <strong id="b"></strong></p>
                                <p>Message : <strong id="c"></strong></p>
                            </div>
                            <h2 class="text-dark">Produits</h2>
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
                            <div class="alert alert-success">
                                <p id="totalAmount">Total à payer : <strong id="total"> 0 </strong> DH</p>
                            </div>

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col">Date</th>
                                    <th scope="col">Nom Complet</th>
                                    <th scope="col">Téléphone</th>
                                    <th scope="col">nbr Produits</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($commands as $command)
                                <tr class="text-light command-row" data-statut="{{ $command->statut }}">
                                    <td>{{ $command->created_at }}</td>
                                    <td>{{ $command->nomComplet }}</td>
                                    <td>{{ $command->telephone }}</td>
                                    @php $array = explode('_', $command->listeProduits); @endphp
                                    <td>{{ count($array)/2 }}</td>
                                    <td>{{ $command->statut }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" onclick="showProducts(
                                            '{{ $command->listeProduits }}',
                                            '{{ $command->nomComplet }}',
                                            '{{ $command->telephone }}',
                                            '{{ $command->message }}'
                                            )">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a class="btn btn-sm btn-success"
                                            href="{{ route('commande.validate', ['commande'=>$command->id]) }}">
                                            <i class="bi bi-check"></i>
                                        </a>
                                        <a class="btn btn-sm btn-warning"
                                            href="{{ route('commande.discard', ['commande'=>$command->id]) }}">
                                            <i class="bi bi-x"></i>
                                        </a>
                                        <a class="btn btn-sm btn-danger"
                                            href="{{ route('commande.delete', ['commande'=>$command->id]) }}">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->



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
    <script src="back/lib/chart/chart.min.js"></script>
    <script src="back/lib/easing/easing.min.js"></script>
    <script src="back/lib/waypoints/waypoints.min.js"></script>
    <script src="back/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="back/lib/tempusdominus/js/moment.min.js"></script>
    <script src="back/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="back/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="back/js/main.js"></script>

    <style>
        /* Style the modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 50%;
            margin-left: 25%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            background-color: #fefefe;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* Style the close button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</body>

</html>