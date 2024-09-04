<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help - Vogue Venture</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.1/css/boxicons.min.css">
    <link rel="stylesheet" href="help.css"> <!-- Include updated CSS file -->
</head>
<body>
    <?php
        include_once 'header.php'; // Include the header file
    ?>

    <div class="container">
        <section class="help-section">
            <h2>What do you need help with?</h2>
            <p>Explore our categories and topics to find answers to your questions.</p>
        </section>

        <!-- Categories Section -->
        <div class="help-topics">
            <div class="help-topic-card" onclick="toggleAnswer('ordering')">
                <i class='bx bx-cart icon'></i>
                <h3>Ordering Shoes</h3>
                <div class="answer" id="ordering">
                    <p>To order shoes, browse our catalog, select your size, and add the item to your cart. Proceed to checkout when you're ready to complete your purchase.</p>
                </div>
            </div>

            <div class="help-topic-card" onclick="toggleAnswer('shipping')">
                <i class='bx bx-package icon'></i>
                <h3>Shipping & Delivery</h3>
                <div class="answer" id="shipping">
                    <p>We offer various shipping options, including standard and expedited. You can track your shipment using the tracking number provided in your order confirmation email.</p>
                </div>
            </div>

            <div class="help-topic-card" onclick="toggleAnswer('returns')">
                <i class='bx bx-refresh icon'></i>
                <h3>Returns & Exchanges</h3>
                <div class="answer" id="returns">
                    <p>You can return or exchange items within 30 days of purchase. Please ensure the shoes are in their original condition.</p>
                </div>
            </div>

            <div class="help-topic-card" onclick="toggleAnswer('sizing')">
                <i class='bx bx-ruler icon'></i>
                <h3>Sizing Guide</h3>
                <div class="answer" id="sizing">
                    <p>Our sizing guide provides detailed measurements to help you choose the right size. If you're between sizes, we recommend selecting the larger size.</p>
                </div>
            </div>
        </div>

        <!-- Popular Topics Section -->
        <section class="help-section">
            <h2>Popular Topics</h2>
        </section>

        <div class="help-topics">
            <div class="help-topic-card" onclick="toggleAnswer('trackOrder')">
                <i class='bx bx-map icon'></i>
                <h3>How do I track my order?</h3>
                <div class="answer" id="trackOrder">
                    <p>You can track your order by entering the tracking number provided in your confirmation email on our tracking page.</p>
                </div>
            </div>

            <div class="help-topic-card" onclick="toggleAnswer('returnPolicy')">
                <i class='bx bx-book icon'></i>
                <h3>What is the return policy?</h3>
                <div class="answer" id="returnPolicy">
                    <p>Our return policy allows for returns within 30 days. The item must be in new condition with the original packaging.</p>
                </div>
            </div>

            <div class="help-topic-card" onclick="toggleAnswer('shoeSize')">
                <i class='bx bx-ruler icon'></i>
                <h3>How to choose the right shoe size?</h3>
                <div class="answer" id="shoeSize">
                    <p>Refer to our sizing guide to find your correct shoe size. We recommend measuring your feet and comparing them to our chart.</p>
                </div>
            </div>

            <div class="help-topic-card" onclick="toggleAnswer('paymentMethods')">
                <i class='bx bx-credit-card icon'></i>
                <h3>Payment methods available</h3>
                <div class="answer" id="paymentMethods">
                    <p>We accept various payment methods, including credit/debit cards, PayPal, and Apple Pay. Select your preferred option at checkout.</p>
                </div>
            </div>
        </div>
    </div>

    <?php
        include_once 'footer.php'; // Include the footer file
    ?>

    <script>
        function toggleAnswer(id) {
            var answer = document.getElementById(id);
            if (answer.style.display === "none" || answer.style.display === "") {
                answer.style.display = "block";
            } else {
                answer.style.display = "none";
            }
        }
    </script>
</body>
</html>
