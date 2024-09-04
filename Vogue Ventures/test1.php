<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="checkout.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <div class="nav-bar">
                <i class="bx bx-menu sidebarOpen"></i>
                <span class="logo navLogo"><img id="logo" src="./logotp.png" alt="Logo"></span>
                <div class="menu">
                    <div class="logo-toggle">
                        <span class="logo"><img id="sidebar-logo" src="./logotp.png" alt="Sidebar Logo"></span>
                        <i class="bx bx-x siderbarClose"></i>
                    </div>
                    <ul class="nav-links">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="Men's Shoes.html">Men's Shoes</a></li>
                        <li><a href="Women's Shoes.html">Women's Shoes</a></li>
                        <li><a href="Kids' Shoes.html">Kids' Shoes</a></li>
                        <li><a href="#">Sale</a></li>
                    </ul>
                </div>
                <div class="darkLight-searchBox">
                    <div class="cart-btn">
                        <a href="#" class="cart-link">
                            <i class="bx bx-cart cart"></i>
                        </a>
                    </div>
                    <div class="login-btn">
                        <a href="#" class="login-link">
                            <i class="bx bx-user user"></i>
                        </a>
                    </div>
                    <div class="searchBox">
                        <div class="searchToggle">
                            <i class="bx bx-x cancel"></i>
                            <i class="bx bx-search search"></i>
                        </div>
                        <div class="search-field">
                            <input type="text" placeholder="Search..." />
                            <i class="bx bx-search"></i>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <section class="checkout-section">
            <h2 class="checkout">Checkout</h2>
            <form id="checkout-form" action="checkout.php" method="post">
                <!-- Contact Information -->
                <h2>Contact Information</h2>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email address" required>
                </div>
                <div class="offers">
                    <input type="checkbox" id="newsletter" name="newsletter">
                    <label for="newsletter">Email me with news and offers</label>
                </div><br>

                <!-- Shipping Address -->
                <h2>Shipping Address</h2>
                <div class="input-group">
                    <label for="first-name">First Name</label>
                    <input type="text" name="first-name" id="first-name" placeholder="Enter your first name" required>
                </div>
                <div class="input-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" name="last-name" id="last-name" placeholder="Enter your last name" required>
                </div>
                <div class="input-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" placeholder="Enter your address" required>
                </div>
                <div class="input-group">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" placeholder="Enter your city" required>
                </div>
                <div class="input-group">
                    <label for="country">Country/Region</label>
                    <select name="country" id="country" required>
                        <option value="LK">Sri Lanka</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="province">Province</label>
                    <select name="province" id="province" required>
                        <option value="Western">Western</option>
                        <option value="Central">Central</option>
                        <option value="Southern">Southern</option>
                        <option value="Northern">Northern</option>
                        <option value="Eastern">Eastern</option>
                        <option value="North Western">North Western</option>
                        <option value="North Central">North Central</option>
                        <option value="Uva">Uva</option>
                        <option value="Sabaragamuwa">Sabaragamuwa</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="zip">ZIP Code</label>
                    <input type="text" name="zip" id="zip" placeholder="Enter your ZIP code" required>
                </div>
                <div class="input-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" name="phone" id="phone" placeholder="Enter your phone number" required>
                </div>

                <!-- Order Summary -->
                <h2>Order Summary</h2>
                <table class="order-summary">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Dynamic order items go here -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">Subtotal</td>
                            <td id="subtotal">$0.00</td>
                        </tr>
                        <tr>
                            <td colspan="2">Shipping</td>
                            <td id="shipping">$0.00</td>
                        </tr>
                        <tr>
                            <td colspan="2">Total</td>
                            <td id="total">$0.00</td>
                        </tr>
                    </tfoot>
                </table>
                <div class="terms">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">I agree to the <a href="#">Terms and Conditions</a></label>
                </div><br>
                <button type="submit" id="place-order">Place Order</button>
            </form>
        </section>
    </main>
    <script>
window.onload = function() {
    // Retrieve the subtotal from local storage
    const subtotal = parseFloat(localStorage.getItem('subtotal') || '0.00');

    const defaultShippingCost = 5.00; 
    const freeShippingProvince = 'Western';
    
     // Retrieve cart data from local storage
     let cartData = JSON.parse(localStorage.getItem('cartData')) || [];
     
     // Check if cartData is an array
     if (Array.isArray(cartData)) {
         const tbody = document.querySelector('.order-summary tbody');
 
         // Clear existing rows
         tbody.innerHTML = '';
 
         // Calculate total quantity and price for each item
         cartData.forEach(item => {
             const tr = document.createElement('tr');
             tr.innerHTML = `
                 <td>${item.name}</td>
                 <td>${item.quantity}</td>
                 <td>$${(item.price * item.quantity).toFixed(2)}</td>
             `;
             tbody.appendChild(tr);
         });
     }
 
     const subtotalElement = document.getElementById('subtotal');
     const shippingElement = document.getElementById('shipping');
     const totalElement = document.getElementById('total');
 
     subtotalElement.textContent = $${subtotal.toFixed(2)};
 
     // Calculate shipping and total based on conditions
     const provinceSelect = document.getElementById('province');
 
     // Update shipping cost and total when province is changed
     provinceSelect.addEventListener('change', () => {
         const selectedProvince = provinceSelect.value;
         const shippingCost = selectedProvince === freeShippingProvince ? 0.00 : defaultShippingCost;
         const total = subtotal + shippingCost;
 
         shippingElement.textContent = $${shippingCost.toFixed(2)};
         totalElement.textContent = $${total.toFixed(2)};
     });
 
     // Set initial shipping and total values
     const initialProvince = provinceSelect.value;
     const initialShippingCost = initialProvince === freeShippingProvince ? 0.00 : defaultShippingCost;
     const initialTotal = subtotal + initialShippingCost;
 
     shippingElement.textContent = $${initialShippingCost.toFixed(2)};
     totalElement.textContent = $${initialTotal.toFixed(2)};
 
    const form = document.getElementById('checkout-form');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const shipping = parseFloat(shippingElement.textContent.replace('$', ''));
        const total = parseFloat(totalElement.textContent.replace('$', ''));
        
        const formData = new FormData(form);
        formData.append('subtotal', subtotal.toFixed(2));
        formData.append('shipping', shipping.toFixed(2));
        formData.append('total', total.toFixed(2));
        
        fetch('checkout.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
}
    </script>
</body>
</html>


<?php
include 'configdb.php';

// Retrieve POST data
$email = $_POST['email'];
$newsletter = isset($_POST['newsletter']) ? 1 : 0;
$first_name = $_POST['first-name'];
$last_name = $_POST['last-name'];
$address = $_POST['address'];
$city = $_POST['city'];
$country = $_POST['country'];
$province = $_POST['province'];
$zip = $_POST['zip'];
$phone = $_POST['phone'];
$subtotal = isset($_POST['subtotal']) ? floatval($_POST['subtotal']) : 0.00;
$shipping = isset($_POST['shipping']) ? floatval($_POST['shipping']) : 0.00;
$total = isset($_POST['total']) ? floatval($_POST['total']) : 0.00;
$terms = isset($_POST['terms']) ? 1 : 0;

// Prepare and bind
$sql = "INSERT INTO orders (email, newsletter, first_name, last_name, s_address, city, country, province, zip, phone, subtotal, shipping, total, terms) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo 'Error in statement preparation';
    exit();
}

mysqli_stmt_bind_param($stmt, "sissssssssdddi", $email, $newsletter, $first_name, $last_name, $address, $city, $country, $province, $zip, $phone, $subtotal, $shipping, $total, $terms);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
$conn->close();
echo 'Order placed successfully';
?>