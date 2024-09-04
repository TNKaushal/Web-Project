<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Montserrat:wght@700&display=swap">
    <style>
        /* Basic Reset */
        body,
        h1,
        p,
        button {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        /* Cart Container */
        .cart-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 900px;
            width: 100%;
        }

        /* Heading Styling */
        h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2em;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        /* Cart Items */
        .cart-items {
            border-top: 2px solid #e0e0e0;
            margin-bottom: 30px;
            padding-top: 20px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-bottom: 20px;
            padding: 15px 0;
            border-bottom: 1px solid #e0e0e0;
            transition: background-color 0.3s ease;
        }

        .cart-item:hover {
            background-color: #f5f5f5;
        }

        .cart-item img {
            width: 100px;
            height: 100px;
            border-radius: 10px;
            margin-right: 20px;
            object-fit: cover;
        }

        .item-details {
            flex-grow: 1;
            font-size: 1.1em;
            min-width: 200px;
        }

        .item-details h3 {
            font-size: 1.2em;
            color: #333;
            margin-bottom: 5px;
        }

        .item-details p {
            color: #666;
            margin-bottom: 10px;
        }

        .item-total {
            font-size: 1.4em;
            color: #27ae60;
            font-weight: 700;
            margin-left: auto;
        }

        .quantity {
            display: flex;
            align-items: center;
        }

        .quantity button {
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            padding: 5px 10px;
            font-size: 1em;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .quantity button:hover {
            background-color: #e0e0e0;
        }

        .remove-btn {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            padding: 10px 15px;
            font-size: 0.9em;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .remove-btn:hover {
            background-color: #c0392b;
        }

        /* Cart Summary */
        .cart-summary {
            text-align: right;
        }

        .cart-summary p {
            font-size: 1.5em;
            margin-bottom: 20px;
            color: #333;
        }

        .cart-summary button {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 15px 20px;
            font-size: 1em;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .cart-summary button:hover {
            background-color: #2980b9;
        }

        #continue-shopping {
            background-color: #2ecc71;
            margin-right: 10px;
        }

        #continue-shopping:hover {
            background-color: #27ae60;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .cart-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .item-details {
                margin-top: 10px;
            }

            .item-total {
                margin-top: 10px;
                font-size: 1.2em;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.5em;
            }

            .cart-summary p {
                font-size: 1.2em;
            }

            .cart-summary button {
                padding: 10px 15px;
                font-size: 0.9em;
            }
        }
    </style>
</head>

<body>
    <div class="cart-container">
        <h1>My Cart</h1>
        <div class="cart-items" id="cart-items">
            <!-- Items will be dynamically added here -->
        </div>
        <div class="cart-summary">
            <p>Total: $<span id="total-amount">0.00</span></p>
            <button id="checkout">Checkout</button>
            <button id="continue-shopping">Continue Shopping</button>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetchItems();

            document.getElementById('continue-shopping').addEventListener('click', function () {
                window.location.href = 'index.php'; // Replace with your actual page URL
            });

            document.getElementById('checkout').addEventListener('click', function () {
                window.location.href = 'checkout.php';
            });
        });

        function fetchItems() {
            let cartData = JSON.parse(localStorage.getItem('cart1')) || [];
            console.log('Cart:', cartData);

            const cartItemsContainer = document.getElementById('cart-items');
            cartItemsContainer.innerHTML = '';
            let subtotalPrice = 0;

            cartData.forEach((item, index) => {
                const cartItem = document.createElement('div');
                cartItem.className = 'cart-item';

                cartItem.innerHTML = `
                    <img src="${item.imageUrl}" alt="${item.name}">
                    <div class="item-details">
                        <h3>${item.name}</h3>
                        <p>Size: ${item.size}</p>
                        <p>Price: $${item.price}</p>
                        <div class="quantity">
                            <button class="btn btn-sm btn-outline-secondary btn_Qnt" onclick="changeQuantity('${index}', ${item.quantity - 1})">-</button>
                            ${item.quantity}
                            <button class="btn btn-sm btn-outline-secondary btn_Qnt" onclick="changeQuantity('${index}', ${item.quantity + 1})">+</button>
                        </div>
                        <button class="remove-btn" onclick="removeItem('${index}')">Remove</button>
                    </div>
                    <p class="item-total">$${(item.price * item.quantity).toFixed(2)}</p>
                `;
                cartItemsContainer.appendChild(cartItem);

                subtotalPrice += item.price * item.quantity;
            });

            document.getElementById('total-amount').innerText = subtotalPrice.toFixed(2);
            localStorage.setItem('subTotal', subtotalPrice);    
        }

        function removeItem(index) {
            let cartData = JSON.parse(localStorage.getItem('cart1')) || [];
            cartData.splice(index, 1);
            localStorage.setItem('cart1', JSON.stringify(cartData));
            fetchItems();
        }

        function changeQuantity(index, newQuantity) {
            let cartData = JSON.parse(localStorage.getItem('cart1')) || [];
            
            if (newQuantity > 0) {
                cartData[index].quantity = newQuantity;
                localStorage.setItem('cart1', JSON.stringify(cartData));
                fetchItems();
            }
        }
    </script>
</body>

</html>
