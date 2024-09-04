<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Vogue Venture</title>
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px 0;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
        }

        /* About Section */
        .about-section, .purpose-mission-section {
            background-color: #ffffff;
            padding: 40px 0;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .about-content, .mission-content {
            flex: 1 1 50%;
            padding: 20px;
            box-sizing: border-box;
        }

        .about-content h2, .mission-content h2 {
            color: #333;
            font-size: 30px;
            margin-bottom: 20px;
            display: flex;
            align-items: center; /* Align icon and text */
        }

        .about-content h2 i, .mission-content h2 i {
            font-size: 36px;
            margin-right: 10px; /* Spacing between icon and text */
            color: #007bff; /* Icon color */
        }

        .about-content p, .mission-content p, .mission-content ul {
            color: #555;
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .mission-content ul {
            padding-left: 20px;
        }

        .mission-content ul li {
            margin-bottom: 10px;
        }

        /* Images */
        .about-image, .mission-image {
            flex: 1 1 40%;
            padding: 20px;
            text-align: center;
        }

        .about-image img, .mission-image img {
            width: 100%;
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        /* Responsive Media Queries */
        @media (max-width: 768px) {
            .container {
                width: 90%;
                flex-direction: column;
                align-items: center;
            }

            .about-content, .mission-content, .about-image, .mission-image {
                flex: 1 1 100%;
                margin-bottom: 20px;
            }

            .about-content h2, .mission-content h2 {
                font-size: 26px;
            }

            .about-content p, .mission-content p, .mission-content ul {
                font-size: 16px;
            }
        }

        @media (max-width: 480px) {
            .about-content h2, .mission-content h2 {
                font-size: 22px;
            }

            .about-content p, .mission-content p, .mission-content ul {
                font-size: 14px;
            }

            .about-image img, .mission-image img {
                width: 100%;
                max-width: 90%;
            }
        }
    </style> <!-- Link to the regenerated CSS file -->
</head>
<body>
    <?php include_once 'header.php'; ?> <!-- Include header using PHP -->

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <h2><i class='bx bxs-home'></i> Welcome to Vogue Venture</h2> <!-- Added Icon -->
                <p>Welcome to Vogue Venture, where your quest for the perfect pair of shoes ends. We pride ourselves on offering an exceptional collection of branded footwear that merges style, quality, and comfort. Whether you're in search of the latest trends, timeless classics, or specialized footwear for any occasion, our selection is designed to meet your every need. Each shoe in our collection is handpicked from the most reputable brands, ensuring that you step out in confidence, no matter where your day takes you.</p>
                <p>At Vogue Venture, we believe that the right pair of shoes can elevate not just your outfit, but your entire outlook. That’s why we are dedicated to providing an unparalleled shopping experience, with easy navigation, detailed product information, and a team of experts ready to assist you. Whether you're shopping for a special event, your daily grind, or a weekend adventure, we are here to help you find shoes that reflect your unique style and personality. Step into a world of fashion and function—welcome to Vogue Venture.</p>
            </div>
            <div class="about-image">
                <img src="img/as1.jpeg" alt="Athletic Shoes 1">
            </div>
        </div>
    </section>

    <!-- Purpose and Mission Section -->
    <section class="purpose-mission-section">
        <div class="container">
            <div class="mission-content">
                <h2><i class='bx bxs-bullseye'></i> Our Purpose</h2> <!-- Added Icon -->
                <p>Our purpose is simple: to provide you with top-quality footwear that enhances your style, comfort, and performance. We understand that shoes are more than just an accessory—they're an essential part of your daily life. That's why we are dedicated to offering a wide range of styles, ensuring that you find the perfect pair for every occasion.</p>
                
                <h2><i class='bx bxs-flag-alt'></i> Our Mission</h2> <!-- Added Icon -->
                <p>Our mission is to become the most trusted and reliable online destination for branded footwear. We aim to achieve this by:</p>
                <ul>
                    <li><strong>Offering a Curated Selection:</strong> We partner with top global brands to bring you a diverse and exclusive range of shoes that cater to various tastes and preferences.</li>
                    <li><strong>Ensuring Quality and Comfort:</strong> We prioritize the quality and comfort of our products, ensuring that each pair of shoes we offer meets the highest standards.</li>
                    <li><strong>Providing Exceptional Customer Service:</strong> Our team is committed to delivering a seamless shopping experience, from browsing our collection to receiving your order. We are here to assist you every step of the way.</li>
                    <li><strong>Staying Ahead of Trends:</strong> We continuously update our collection with the latest styles and innovations in footwear, so you can always stay ahead in the fashion game.</li>
                </ul>
            </div>
            <div class="mission-image">
                <img src="img/as2.jpeg" alt="Athletic Shoes 2">
            </div>
        </div>
    </section>

    <?php include_once 'footer.php'; ?> <!-- Include footer using PHP -->
</body>
</html>
