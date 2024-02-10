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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Les Commandes</h6>
                        <div class="mb-3">
                            <label for="filterStatut" class="form-label">Filtrer : </label>
                            <select class="form-select" id="filterStatut" onchange="filterCommands()">
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
            <script>
                function filterCommands() {
                    var selectedStatut = document.getElementById('filterStatut').value;
                    var rows = document.querySelectorAll('.command-row');

                    rows.forEach(function (row) {
                        var rowStatut = row.getAttribute('data-statut');
                        if (selectedStatut === 'all' || rowStatut === selectedStatut) {
                            row.style.display = 'table-row';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                }
            </script>
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