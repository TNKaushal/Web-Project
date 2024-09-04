<?php
include 'includes/functions.inc.php'; // Adjust the path as needed

// Check if the user is logged in
if (!isLoggedIn()) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Database connection settings
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password is empty
$dbname = "vogue_ventures2"; // Replace with your actual database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data for select options
$brands = $conn->query("SELECT brand_id, brand_name FROM brands");
$categories = $conn->query("SELECT category_id, category_name FROM categories");
$topSellings = $conn->query("SELECT topselling_id, status FROM top_selling");
$sales = $conn->query("SELECT sale_id, status FROM sale");

// Handling form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productName = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $color = $_POST['color'];
    $brandId = $_POST['brand_id'];
    $categoryId = $_POST['category_id'];
    $topsellingId = $_POST['topselling_id'];
    $saleId = $_POST['sale_id'];
    $stockQuantity = $_POST['stock_quantity'];
    $sizes = $_POST['sizes'];

    // Initialize variables for image file paths
    $imageFilePath1 = $imageFilePath2 = '';

    // Handle file uploads
    if (isset($_FILES['image1']) && is_uploaded_file($_FILES['image1']['tmp_name'])) {
        if ($_FILES['image1']['error'] == 0) {
            $imageFileName1 = basename($_FILES['image1']['name']);
            $targetDirectory = "images/";
            $imageFilePath1 = $targetDirectory . $imageFileName1;

            if (!move_uploaded_file($_FILES['image1']['tmp_name'], $imageFilePath1)) {
                echo "Error uploading the first image.";
                exit();
            }
        } else {
            echo "Error uploading the first image: " . $_FILES['image1']['error'];
            exit();
        }
    } else {
        echo "Please select a valid first image file.";
        exit();
    }

    if (isset($_FILES['image2']) && is_uploaded_file($_FILES['image2']['tmp_name'])) {
        if ($_FILES['image2']['error'] == 0) {
            $imageFileName2 = basename($_FILES['image2']['name']);
            $imageFilePath2 = $targetDirectory . $imageFileName2;

            if (!move_uploaded_file($_FILES['image2']['tmp_name'], $imageFilePath2)) {
                echo "Error uploading the second image.";
                exit();
            }
        } else {
            echo "Error uploading the second image: " . $_FILES['image2']['error'];
            exit();
        }
    } else {
        echo "Please select a valid second image file.";
        exit();
    }

    if (isset($_FILES['image2']) && is_uploaded_file($_FILES['image2']['tmp_name'])) {
        if ($_FILES['image2']['error'] == 0) {
            $imageFileName2 = basename($_FILES['image2']['name']);
            $imageFilePath2 = $targetDirectory . $imageFileName2;

            if (!move_uploaded_file($_FILES['image2']['tmp_name'], $imageFilePath2)) {
                echo "Error uploading the second image.";
                exit();
            }
        } else {
            echo "Error uploading the second image: " . $_FILES['image2']['error'];
            exit();
        }
    } else {
        echo "Please select a valid second image file.";
        exit();
    }

    // Prepare SQL Insert query for product
    $sqlInsertProduct = "INSERT INTO products (name, description, price, color, brand_id, category_id, topselling_id, sale_id, stock_quantity, image_url1, image_url2) 
                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sqlInsertProduct);
    if ($stmt === false) {
        die('Error preparing the statement: ' . $conn->error);
    }

    // Bind the parameters
    $stmt->bind_param(
        "ssdsiiiiiis", 
        $productName, 
        $description, 
        $price, 
        $color, 
        $brandId, 
        $categoryId, 
        $topsellingId, 
        $saleId, 
        $stockQuantity, 
        $imageFilePath1, 
        $imageFilePath2
    );

    // Execute the SQL statement
    if ($stmt->execute()) {
        $productId = $stmt->insert_id;

        // Insert sizes into the product_sizes table
        $sqlInsertSize = "INSERT INTO product_sizes (product_id, size) VALUES (?, ?)";
        $sizeStmt = $conn->prepare($sqlInsertSize);

        if ($sizeStmt === false) {
            die('Error preparing the size statement: ' . $conn->error);
        }

        foreach ($sizes as $size) {
            $sizeStmt->bind_param("is", $productId, $size);
            $sizeStmt->execute();
        }

        // Redirect after successful insert
        header("Location: list_products.php");
        exit();
    } else {
        echo "Error executing product insert: " . $stmt->error;
    }
}

// Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
    <style>
        .form-container {
            width: 100%;
            max-width: 2100px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }
        .checkbox-group {
            display: flex;
            gap: 10px;
        }
        .checkbox-group label {
            display: flex;
            align-items: center;
        }
        .logo img {
            height: 40px;
        }
        .image-preview {
            margin-top: 10px;
        }
        .image-preview img {
            width: 100px;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <span class="logo navLogo"><img id="logo" src="img/logotp2.png" alt="Logo"></span>
            </div>
            <ul class="menu">
                <li><a href="admin.php">Dashboard</a></li>
                <li><a href="add_product.php">Add Product</a></li>
                <li><a href="list_products.php">List Products</a></li>
                <li><a href="orders.php">Orders</a></li>
                <li><a href="customers.php">Customers</a></li>
                <li><a href="includes/logout.inc.php">Logout</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <header>
                <h1>Add Product</h1>
            </header>
            <section class="content">
                <div class="form-container">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="product_name">Product Name</label>
                            <input type="text" id="product_name" name="product_name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" id="price" name="price" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="sizes">Sizes</label>
                            <div class="checkbox-group">
                                <?php
                                $sizes = [6, 7, 8, 9, 10, 11];
                                foreach ($sizes as $size) {
                                    echo '<label><input type="checkbox" name="sizes[]" value="' . $size . '"> ' . $size . '</label>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="color">Color</label>
                            <input type="color" id="color" name="color" required>
                        </div>
                        <div class="form-group">
                            <label for="brand_id">Brand</label>
                            <select id="brand_id" name="brand_id" required>
                                <option value="">Select Brand</option>
                                <?php while ($row = $brands->fetch_assoc()): ?>
                                    <option value="<?= $row['brand_id']; ?>"><?= $row['brand_name']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select id="category_id" name="category_id" required>
                                <option value="">Select Category</option>
                                <?php while ($row = $categories->fetch_assoc()): ?>
                                    <option value="<?= $row['category_id']; ?>"><?= $row['category_name']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="topselling_id">Top Selling</label>
                            <select id="topselling_id" name="topselling_id" required>
                                <option value="">Select Top Selling Status</option>
                                <?php while ($row = $topSellings->fetch_assoc()): ?>
                                    <option value="<?= $row['topselling_id']; ?>"><?= $row['status']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sale_id">Sale</label>
                            <select id="sale_id" name="sale_id" required>
                                <option value="">Select Sale Status</option>
                                <?php while ($row = $sales->fetch_assoc()): ?>
                                    <option value="<?= $row['sale_id']; ?>"><?= $row['status']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="stock_quantity">Stock Quantity</label>
                            <input type="number" id="stock_quantity" name="stock_quantity" required>
                        </div>
                        <div class="form-group">
                            <label for="image1">Image 1</label>
                            <input type="file" id="image1" name="image1" accept="image/*" required onchange="previewImage(event, 'preview1')">
                            <div id="preview1" class="image-preview"></div>
                        </div>
                        <div class="form-group">
                            <label for="image2">Image 2</label>
                            <input type="file" id="image2" name="image2" accept="image/*" required onchange="previewImage(event, 'preview2')">
                            <div id="preview2" class="image-preview"></div>
                        </div>
                        <button type="submit" class="btn">Add Product</button>
                    </form>
                </div>
            </section>
        </main>
    </div>

    <script>
    function previewImage(event, previewId) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById(previewId);
            output.innerHTML = '<img src="' + reader.result + '" alt="Image Preview">';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
    </script>
</body>
</html>
