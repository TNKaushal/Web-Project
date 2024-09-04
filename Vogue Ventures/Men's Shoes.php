<?php
include_once 'configdb.php';

// SQL query to fetch products by category_id
$sql = "SELECT p.*
        FROM products p
        WHERE p.category_id = 1
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
    <title>Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="styles.css">

</head>

<body>
    <?php include_once 'header.php'; // Include the header ?>

    <!-- Icon Section -->
    <section class="icon-row">
        <div class="icon-container">
            <img src="img/slogo1.png" alt="Logo 1" class="icon">
            <img src="img/slogo2.png" alt="Logo 2" class="icon">
            <img src="img/slogo3.png" alt="Logo 3" class="icon">
            <img src="img/slogo4.png" alt="Logo 4" class="icon">
            <img src="img/slogo5.png" alt="Logo 5" class="icon">
            <img src="img/slogo6.png" alt="Logo 6" class="icon">
            <img src="img/slogo7.png" alt="Logo 7" class="icon">
        </div>
    </section>
    <br>

    <!-- Men's Shoes Collection Section -->
    <section class="top-selling">
    <p class="custom-font2">Men's Shoes Collection</p>
        <div id="card-container" class="card-container">
            <!-- Cards will be dynamically populated here -->
        </div>
    </section>

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
                            <div class="card">
                                <div class="image-wrapper">
                                    <img src="admin/${product.image_url1}" class="img-fluid image-front" alt="${product.name}">
                                    ${product.image_url2 ? `<img src="admin/${product.image_url2}" class="img-fluid image-back" alt="${product.name}">` : ''}
                                </div>
                                <div class="card-content">
                                    <h3>${product.name}</h3>
                                    <p>$ ${product.price}</p><br>
                                    <a href="productitem.php?id=${product.product_id}&category=${product.category_id}" class="btn">Explore</a>
                                </div>
                            </div>
                    `;
                });
            }


            renderProducts(products); // Render the products on page load
        });
    </script>

    <?php include_once 'footer.php'; // Include the footer ?>
</body>

</html>
