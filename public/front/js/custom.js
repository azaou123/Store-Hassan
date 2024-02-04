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
