<?php
include_once 'header.php'; // Binding header file to the index file
include_once 'configdb.php';

// SQL query to fetch products with topselling_id = 1
$sql = "SELECT p.product_id, p.name, p.price, p.image_url1, p.image_url2, p.category_id
        FROM products p
        WHERE p.topselling_id = 2
        GROUP BY p.product_id";

// Prepare the statement and handle any errors
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die('Error preparing the statement: ' . $conn->error);
}

// Execute the statement and handle any errors
if (!$stmt->execute()) {
    die('Error executing the statement: ' . $stmt->error);
}

$result = $stmt->get_result();

$products = [];

// Fetch products and store them in an array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoe Store</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Background Slider -->
    <div class="background-slider">
        <div class="slide"></div>
        <div class="slide"></div>
        <div class="text-overlay">
            <h1>STRIDE WITH CONFIDENCE</h1>
            <p>Discover the perfect blend of style, comfort, and quality with our expertly curated collection of shoes designed to make every step a statement.</p>
        </div>
    </div>

    <!-- Banner -->
    <section class="banner">
        <div class="slider">
            <!-- Add slider images here -->
        </div>
        <div class="dots">
            <!-- Add slider dots here -->
        </div>
    </section>
    <br><br>

    <!-- Icon Section -->
    <section class="icon-row">
        <div class="icon-container">
            <img src="img/slogo1.png" alt="Logo 1" class="icon">
            <img src="img/slogo2.png" alt="Logo 2" class="icon">
            <img src="img/slogo3.png" alt="Logo 3" class="icon">
            <img src="img/slogo4.png" alt="Logo 4" class="icon">
            <img src="img/slogo5.png" alt="Logo 5" class="icon">
            <img src="img/slogo6.png" alt="Logo 6" class="icon">
            <img src="img/slogo7.png" alt="Logo 1" class="icon">
        </div>
    </section>
    <br>

    <div class="split-container">
        <!-- Left Side Content -->
        <div class="left-side">
            <!-- Shoe Categories -->
            <section class="shoe-categories-grid">
                <div class="category" id="run">
                    <img src="img/men-s-shoes-clothing-accessories.jpg" alt="Elevate Your Run">
                    <div class="overlay">
                        <h2 class="custom-font">Elevate Your Run</h2>
                        <p class="custom-font">Discover unmatched comfort and support for every run.</p>
                        <a href="banners.php#elevate-your-run" class="custom-font">LEARN MORE</a>
                    </div>
                </div>
                <div class="category" id="fashion">
                    <img src="img/men-s-shoes-clothing-accessories(1).jpg" alt="Fashion Meets Function">
                    <div class="overlay">
                        <h2 class="custom-font">Fashion Meets Function</h2>
                        <p class="custom-font">Style and comfort for every occasion.</p>
                        <a href="banners.php#fashion-meets-function" class="custom-font">LEARN MORE</a>
                    </div>
                </div>
                <div class="category" id="adventure">
                    <img src="img/men-s-shoes-clothing-accessories(4).jpg" alt="Adventure Awaits">
                    <div class="overlay">
                        <h2 class="custom-font">Adventure Awaits</h2>
                        <p class="custom-font">Durable shoes for all your outdoor escapades.</p>
                        <a href="banners.php#adventure-awaits" class="custom-font">LEARN MORE</a>
                    </div>
                </div>
                <div class="category" id="comfort">
                    <img src="img/men-s-shoes-clothing-accessories(3).jpg" alt="Elevate Your Run">
                    <div class="overlay">
                        <h2 class="custom-font">Unmatched Comfort</h2>
                        <p class="custom-font">Experience the ultimate in comfort with shoes designed to keep you at ease all day long.</p>
                        <a href="banners.php#unmatched-comfort" class="custom-font">LEARN MORE</a>
                    </div>
                </div>
            </section>
        </div>

        <!-- Right Side Content -->
        <div class="right-side">
            <div class="content-wrapper">
                <h1 class="custom-font">Welcome to Our Shoe Store</h1>
                <p class="intro-text">Discover the perfect blend of style, comfort, and quality with our exclusive collection. Whether you’re running a marathon, hitting the gym, or enjoying a casual day out, we have the perfect shoes for you.</p> 
                <h2 class="custom-font">Why Shop With Us?</h2>
                <ul class="benefits-list">
                    <li class="intro-text"><strong>Wide Range of Styles</strong>: Find shoes for every occasion, from sports to fashion.</li>
                    <li class="intro-text"><strong>Premium Quality Materials</strong>: Made with top-quality materials to ensure comfort and durability.</li>
                    <li class="intro-text"><strong>Exclusive Designs</strong>: Unique and trendy styles curated by fashion experts.</li>
                    <li class="intro-text"><strong>Excellent Customer Service</strong>: Dedicated support with easy returns and exchanges.</li>
                </ul>
                <div class="custom-font">
                    <a href="sale.php" class="btn-shop-now">Shop Now</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Scrolling -->
    <div class="card-carousel">
        <div class="card1">
            <img src="img/cPicture1.jpg" alt="Card Image 1">
        </div>
        <div class="card1">
            <img src="img/cPicture2.jpg" alt="Card Image 2">
        </div>
        <div class="card1">
            <img src="img/cPicture3.jpg" alt="Card Image 3">
        </div>
        <div class="card1">
            <img src="img/cPicture4.jpg" alt="Card Image 4">
        </div>
        <div class="card1">
            <img src="img/cPicture5.jpg" alt="Card Image 5">
        </div>
    </div>

    <!-- Top Selling Section -->
    <section class="top-selling">
        <p class="custom-font2">Top Selling & Trending</p>
        <div id="card-container" class="card-container">
            <!-- Cards will be rendered here by JavaScript -->
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const productList = document.getElementById('card-container');
            const products = <?php echo json_encode($products); ?>; // Pass PHP array to JS

            function renderProducts(products) {
                const screenWidth = window.innerWidth;
                productList.innerHTML = '';

                products.forEach(product => {
                    // Determine the column class based on screen width
                    let colClass = 'col-md-3 mb-3';

                    if (screenWidth < 1300) {
                        colClass = 'col-md-4 mb-3'; // for smaller screens
                    }
                    if (screenWidth < 1000) {
                        colClass = 'col-md-6 mb-3'; // for smaller screens
                    }
                    if (screenWidth < 770) {
                        colClass = 'col-md-3 mb-3 m-4'; // for smaller screens
                    }

                    productList.innerHTML += `
                        <a href="productitem.php?id=${product.product_id}&category=${product.category_id}">
                            <div class="card ${colClass}">
                                <div class="image-wrapper">
                                    <img src="admin/${product.image_url1}" class="img-fluid image-front" alt="${product.name}">
                                    ${product.image_url2 ? `<img src="admin/${product.image_url2}" class="img-fluid image-back" alt="${product.name}">` : ''}
                                </div>
                                <div class="card-content">
                                    <h3>${product.name}</h3>
                                    <p>$${product.price}</p><br>
                                    <a href="productitem.php?id=${product.product_id}&category=${product.category_id}" class="btn">Explore</a>
                                </div>
                            </div>
                        </a>
                    `;
                });
            }

            renderProducts(products); // Render the products on page load
        });
    </script>

    <?php include_once 'footer.php'; // Binding footer file to the index ?>
</body>
</html>
