<?php
include './configdb.php';

// Fetch product details based on product_id
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$product_sql = "SELECT p.*
                FROM products p 
                WHERE p.product_id = ?";

$stmt = $conn->prepare($product_sql);
if ($stmt === false) {
    die('Error preparing the statement: ' . $conn->error);
}

$stmt->bind_param("i", $product_id);
$stmt->execute();
$product_result = $stmt->get_result();
$product = $product_result->fetch_assoc();

// Fetch sizes for the product from product_sizes table
$sizes_sql = "SELECT size FROM product_sizes WHERE product_id = ?";
$sizes_stmt = $conn->prepare($sizes_sql);
if ($sizes_stmt === false) {
    die('Error preparing the statement: ' . $conn->error);
}

$sizes_stmt->bind_param("i", $product_id);
$sizes_stmt->execute();
$sizes_result = $sizes_stmt->get_result();

$sizes = [];
while ($row = $sizes_result->fetch_assoc()) {
    $sizes[] = $row['size'];
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Sans+Serif:wght@400&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jost:wght@600&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Aaargh:wght@400&display=swap">
    <script src="https://kit.fontawesome.com/f29c112359.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-transform: uppercase;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .thumbnail {
            cursor: pointer;
            margin: 0 5px;
        }

        .thumbnail:hover {
            opacity: 0.7;
        }
    </style>
</head>

<body>
    <section class="py-5">
        <div class="container">
            <div class="row gx-5">
                <aside class="col-lg-6">
                    <div class="border rounded-4 mb-3 d-flex justify-content-center">
                        <img id="main-image" style="width: 100%; max-height: 100vh;"
                            class="rounded-4 fit" src="admin/<?= htmlspecialchars($product['image_url1']); ?>"
                            alt="<?= htmlspecialchars($product['name']); ?>" />
                    </div>
                    <div class="d-flex justify-content-center mb-3">
                        <img id="thumb1" width="60" height="60" class="rounded-2 thumbnail"
                            src="admin/<?= htmlspecialchars($product['image_url1']); ?>"
                            alt="<?= htmlspecialchars($product['name']); ?>" />
                        <img id="thumb2" width="60" height="60" class="rounded-2 thumbnail"
                            src="admin/<?= htmlspecialchars($product['image_url2']); ?>"
                            alt="<?= htmlspecialchars($product['name']); ?>" />
                    </div>
                </aside>
                <main class="col-lg-6">
                    <div class="ps-lg-3">
                        <h4 id="product-name" class="title text-dark">
                            <?= htmlspecialchars($product['name']); ?>
                        </h4>
                        <div class="d-flex flex-row my-3">
                            <div class="text-warning mb-1 me-2">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span class="ms-1">4.5</span>
                            </div>
                            <span
                                class="text-success ms-2"><?= $product['stock_quantity'] > 0 ? 'In stock' : 'Out of stock'; ?></span>
                        </div>
                        <div class="mb-3">
                            <span id="product-price" class="h5">$
                                <?= number_format($product['price'], 2); ?></span>
                        </div>
                        <p>
                            <?= htmlspecialchars($product['description']); ?>
                        </p>
                        <div class="row mb-4">
                            <div class="col-md-4 col-6">
                                <label class="mb-2">Size</label>
                                <select id="product-size" class="form-select border border-secondary"
                                    style="height: 35px;">
                                    <?php foreach ($sizes as $size): ?>
                                        <option value="<?= htmlspecialchars($size); ?>">
                                            <?= htmlspecialchars($size); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="card-content">
                            <a href="#" class="btn btn-warning shadow-0">Buy now</a>
                            <a href="#" id="add-to-cart" class="btn btn-primary shadow-0">
                                <i class="me-1 fa fa-shopping-basket"></i> Add to cart
                            </a>
                            <a href="cart.php" class="btn btn-light border border-secondary py-2 icon-hover px-3">
                                <i class="me-1 fa fa-heart fa-lg"></i> Save
                            </a>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </section>

    <script>
        // Function to change the main image
        function changeMainImage(imageSrc) {
            document.getElementById('main-image').src = imageSrc;
        }

        // Add event listeners to thumbnail images
        document.querySelectorAll('.thumbnail').forEach(thumbnail => {
            thumbnail.addEventListener('click', function () {
                changeMainImage(this.src);
            });
        });

        document.getElementById('add-to-cart').addEventListener('click', function (e) {
            e.preventDefault();

            // Get the product details
            const name = document.getElementById('product-name').innerText.trim();
            const size = document.getElementById('product-size').value;
            const price = document.getElementById('product-price').innerText.trim().replace('$ ', '');
            const imageUrl = document.getElementById('main-image').src; // Get the image URL from the main image element
            const quantity = 1;
            // Create an object for the product
            const product = { name, size, price, imageUrl, quantity };

            // Retrieve existing cart data from local storage
            let cart = JSON.parse(localStorage.getItem('cart1'));

            // Check if cart is not an array, then initialize it as an empty array
            if (!Array.isArray(cart)) {
                cart = [];
            }

            // Add the new product to the cart array
            cart.push(product);

            // Save the updated cart array back to local storage
            localStorage.setItem('cart1', JSON.stringify(cart));
            console.log('Cart:', cart); // Debugging output

            // Optionally, alert the user or update the cart UI
            alert('Product added to cart!');
        });
    </script>
</body>

</html>