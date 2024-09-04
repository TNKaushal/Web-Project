window.onload = function() {
    // Default shipping settings
    const defaultShippingCost = 5.00; 
    const freeShippingProvince = 'Western';
    
    // Retrieve cart data from local storage
    let cartData = JSON.parse(localStorage.getItem('cart1')) || [];
    let subtotalPrice = 0;
 
    // Get the order summary table body element
    const orderSummaryBody = document.querySelector('.order-summary tbody');
 
    // Clear any existing rows
    orderSummaryBody.innerHTML = '';
 
    // Populate table with cart items and calculate subtotal
    cartData.forEach(item => {
        const row = document.createElement('tr');
 
        const itemTotal = (item.price * item.quantity).toFixed(2);
        subtotalPrice += parseFloat(itemTotal);
 
        row.innerHTML = `
            <td>${item.name}</td>
            <td>${item.quantity}</td>
            <td>$${itemTotal}</td>
        `;
 
        orderSummaryBody.appendChild(row);
    });

    // Store the calculated subtotal in local storage
    localStorage.setItem('subTotal', subtotalPrice.toFixed(2));

    // Initialize shipping and total calculation
    updateShippingAndTotal(defaultShippingCost, freeShippingProvince, document.getElementById('province').value);
};

document.getElementById('checkout-form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    // Validate if Terms and Conditions checkbox is checked
    if (!document.getElementById('terms').checked) {
        alert('Please agree to the Terms and Conditions.');
        return;
    }

    // Validate email
    const email = document.getElementById('email').value;
    if (!validateEmail(email)) {
        alert('Please enter a valid email address.');
        return;
    }

    // Validate phone number
    const phone = document.getElementById('phone').value;
    if (!validatePhone(phone)) {
        alert('Please enter a valid phone number.');
        return;
    }

    // Retrieve calculated values from the DOM
    const subtotal = parseFloat(document.getElementById('subtotal').innerText.replace('$', '')) || 0;
    const shipping = parseFloat(document.getElementById('shipping').innerText.replace('$', '')) || 0;
    const total = parseFloat(document.getElementById('total').innerText.replace('$', '')) || 0;

    // Prepare form data
    const formData = new FormData(document.getElementById('checkout-form'));

    // Append order amounts to FormData
    formData.append('subtotal', subtotal.toFixed(2));
    formData.append('shipping', shipping.toFixed(2));
    formData.append('total', total.toFixed(2));

    // Send data using fetch
    fetch('checkout.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())  // Handle response as plain text or HTML
    .then(result => {
        alert('Your order has been placed successfully!');
        // Clear local storage after successful checkout
        localStorage.clear();

        // Redirect to home page or any other page
        window.location.href = 'index.php';
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(String(email).toLowerCase());
}

function validatePhone(phone) {
    const re = /^\d{10}$/; // Simple regex for a 10-digit number
    return re.test(String(phone));
}

document.getElementById('province').addEventListener('change', function() {
    const selectedProvince = this.value;
    const defaultShippingCost = 5.00;
    const freeShippingProvince = 'Western';

    // Update shipping and total amounts based on the selected province
    updateShippingAndTotal(defaultShippingCost, freeShippingProvince, selectedProvince);
});

function updateShippingAndTotal(defaultShippingCost, freeShippingProvince, selectedProvince) {
    // Retrieve the subtotal from local storage
    const subtotal = parseFloat(localStorage.getItem('subTotal')) || 0;

    const shippingCost = selectedProvince === freeShippingProvince ? 0 : defaultShippingCost;

    const totalAmount = subtotal + shippingCost;

    // Update the checkout page with the subtotal, shipping, and total values
    document.getElementById('subtotal').innerText = `$${subtotal.toFixed(2)}`;
    document.getElementById('shipping').innerText = `$${shippingCost.toFixed(2)}`;
    document.getElementById('total').innerText = `$${totalAmount.toFixed(2)}`;
}

