<div class="container-fluid">
    <div class="row py-2 px-xl-5" style="background-color : #E48F45;">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center">
                <span class="text-dark">Sélectionner</span>
                <span class="text-muted px-2">|</span>
                <span class="text-dark">Commander</span>
                <span class="text-muted px-2">|</span>
                <span class="text-dark">Confirmer</span>
            </div>

        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                <a class="text-dark px-2" href="{{ $parametres->facebook }}" target="_blank">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a class="text-dark px-2" href="{{ $parametres->instagram }}" target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="text-dark pl-2 px-2" href="mailto:{{ $parametres->email }}" target="_blank">
                    <i class="far fa-envelope"></i>
                </a>
                <a class="text-dark pl-2 px-2" href="{{ $parametres->googlemaps }}" target="_blank">
                    <i class="fas fa-map-marker-alt"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row align-items-center py-1 px-xl-5" style="background-color : #EEF296;">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="" href="{{ route('index') }}">
                <img src="{{ asset('storage/'.$parametres->logo) }}" alt="Logo" class="img-fluid rounded mb-2"
                    style="width:140px; height : 60px;">
            </a>
        </div>
        <div class="col-lg-6 col-6 text-center mt-3">
            <p class="fw-bold">{{ $parametres->address }}</p>
        </div>
        <div class="col-lg-3 col-6 text-right">
            <a class="btn border" data-bs-toggle="modal" data-bs-target="#myModal">
                <i class="fas fa-shopping-cart" style="color : #E48F45;"></i>
                <span id="cardNBR" class="badge text-dark">0</span>
            </a>
        </div>
    </div>
</div>


<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-center">La Commande </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div id="listeProduits">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Prix</th>
                                <th>Qte</th>
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
                            <input class="form-control" id="telephone" name="telephone" type="email"
                                placeholder="Telephone ......" data-sb-validations="required" />
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



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>
<script>
    // Get current year
    function getYear() {
        var currentDate = new Date();
        var currentYear = currentDate.getFullYear();
        document.querySelector("#displayYear").innerHTML = currentYear;
    }

    // Initialize variables
    let productArray = [];
    let liste = [];

    // Function to check if an item exists in the array
    function itemExists(array, key, value) {
        return array.some(item => item[key] === value);
    }

    // Function to add an item to the cart
    // Function to add an item to the cart
    function addToCart(id, productName, price) {
        let newItem = {
            id: id,
            product: productName,
            price: price,
            quantity: 1
        };

        if (!itemExists(productArray, 'id', newItem.id)) {
            productArray.push(newItem);
        } else {
            const existingItem = productArray.find(item => item.id === newItem.id);
            existingItem.quantity += 1;
        }

        // Update the cardNBR directly based on the total quantity of items in the cart
        var totalQuantity = productArray.reduce((total, product) => total + product.quantity, 0);
        document.getElementById('cardNBR').innerText = totalQuantity;

        // Update the cart UI and save to local storage
        updateCart();
    }


    // Function to update the cart UI and save to local storage
    function updateCart() {
        var tableBody = document.getElementById('listProducts');
        var totalAlert = document.getElementById('total');
        var total = 0;

        // Update the cart UI
        tableBody.innerHTML = '';
        productArray.forEach(product => {
            const newRow = document.createElement('tr');
            Object.keys(product).forEach(key => {
                const cell = document.createElement('td');
                if (key === 'id') {
                    cell.setAttribute('style', 'display:none;');
                }
                cell.textContent = product[key];
                newRow.appendChild(cell);
            });

            const btnDecrease = createButton('-', () => decreaseQuantity(product.id));
            const btnIncrease = createButton('+', () => increaseQuantity(product.id));
            const btnDelete = createButton('x', () => deleteProduct(product.id));

            newRow.appendChild(createCell(btnDecrease));
            newRow.appendChild(createCell(btnIncrease));
            newRow.appendChild(createCell(btnDelete));

            tableBody.appendChild(newRow);
            total += product.quantity * product.price;
        });

        // Update the liste array
        liste = productArray.map(product => `${product.id}_${product.quantity}`);

        // Update the total alert
        totalAlert.innerHTML = 'Total to pay: ' + total + ' DH';

        // Save to local storage
        localStorage.setItem('productArray', JSON.stringify(productArray));
        document.getElementById('cardNBR').innerText = productArray.length;
    }

    // Function to create a cell with a button
    function createCell(content) {
        const cell = document.createElement('td');
        cell.appendChild(content);
        return cell;
    }

    // Function to create a button
    function createButton(label, clickHandler) {
        const btn = document.createElement('button');
        btn.textContent = label;
        btn.classList.add('btn', 'fw-bold', 'm-0', 'p-0');
        btn.addEventListener('click', clickHandler);
        return btn;
    }

    // Function to decrease the quantity of an item in the cart
    function decreaseQuantity(productId) {
        const existingItem = productArray.find(item => item.id === productId);
        if (existingItem.quantity > 1) {
            existingItem.quantity -= 1;
        } else {
            deleteProduct(productId);
        }
        updateCart();
    }

    // Function to increase the quantity of an item in the cart
    function increaseQuantity(productId) {
        const existingItem = productArray.find(item => item.id === productId);
        existingItem.quantity += 1;
        updateCart();
    }

    // Function to delete an item from the cart
    function deleteProduct(productId) {
        productArray = productArray.filter(item => item.id !== productId);
        updateCart();
    }

    // Function to show the cart
    function showCart() {
        updateCart();
        // You may add additional code here to customize the cart display (e.g., show/hide animation)
    }

    // Load data from local storage on page load
    function loadFromLocalStorage() {
        const savedProductArray = localStorage.getItem('productArray');
        if (savedProductArray) {
            productArray = JSON.parse(savedProductArray);
            document.getElementById('cardNBR').innerText = productArray.length;
            updateCart();
        }
    }

    // Call the loadFromLocalStorage function on page load

    loadFromLocalStorage();

</script>