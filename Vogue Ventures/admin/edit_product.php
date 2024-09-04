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
$dbname = "vogue_ventures2"; // Your actual database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for update
if (isset($_POST['submit'])) {
    $productId = $_POST['product_id'];
    $productName = $_POST['name'];
    $productPrice = $_POST['price'];
    $productCategoryId = $_POST['category_id'];
    $productDescription = $_POST['description'];
    $productColor = $_POST['color'];
    $productBrandId = $_POST['brand_id'];
    $productStockQuantity = $_POST['stock_quantity'];
    $productImageUrl1 = $_POST['image_url1'];
    $productImageUrl2 = $_POST['image_url2'];

    // Update data in the Products table using prepared statements
    $stmt = $conn->prepare("UPDATE products SET name=?, description=?, price=?, color=?, brand_id=?, category_id=?, stock_quantity=?, image_url1=?, image_url2=? WHERE product_id=?");
    $stmt->bind_param("ssdsiisssi", $productName, $productDescription, $productPrice, $productColor, $productBrandId, $productCategoryId, $productStockQuantity, $productImageUrl1, $productImageUrl2, $productId);

    if ($stmt->execute()) {
        echo "Product updated successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Handle form submission for delete
if (isset($_POST['delete'])) {
    $productId = $_POST['product_id'];

    // Delete data from the Products table using prepared statements
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $productId);

    if ($stmt->execute()) {
        echo "Product deleted successfully";
        // Redirect to the products list page or admin panel after deletion
        header("Location: list_products.php"); 
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch product details for the form
$productId = $_GET['id'];
$sqlProduct = "SELECT * FROM products WHERE product_id = ?";
$stmt = $conn->prepare($sqlProduct);
$stmt->bind_param("i", $productId);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Fetch brands and categories for dropdowns
$brands = [];
$sqlBrands = "SELECT brand_id, brand_name FROM brands";
$resultBrands = $conn->query($sqlBrands);
if ($resultBrands->num_rows > 0) {
    while ($row = $resultBrands->fetch_assoc()) {
        $brands[] = $row;
    }
}

$categories = [];
$sqlCategories = "SELECT category_id, category_name FROM categories";
$resultCategories = $conn->query($sqlCategories);
if ($resultCategories->num_rows > 0) {
    while ($row = $resultCategories->fetch_assoc()) {
        $categories[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <main class="main-content">
        <h1>Edit Product</h1>
        <form action="edit_product.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $product['name']; ?>" required><br>

            <label for="price">Product Price:</label>
            <input type="number" id="price" name="price" step="0.01" value="<?php echo $product['price']; ?>" required><br>

            <label for="category_id">Product Category:</label>
            <select id="category_id" name="category_id" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['category_id']; ?>" <?php echo $category['category_id'] == $product['category_id'] ? 'selected' : ''; ?>><?php echo $category['category_name']; ?></option>
                <?php endforeach; ?>
            </select><br>

            <label for="description">Product Description:</label>
            <textarea id="description" name="description" required><?php echo $product['description']; ?></textarea><br>

            <label for="color">Product Color:</label>
            <input type="color" id="color" name="color" value="<?php echo $product['color']; ?>"><br>

            <label for="brand_id">Brand:</label>
            <select id="brand_id" name="brand_id" required>
                <?php foreach ($brands as $brand): ?>
                    <option value="<?php echo $brand['brand_id']; ?>" <?php echo $brand['brand_id'] == $product['brand_id'] ? 'selected' : ''; ?>><?php echo $brand['brand_name']; ?></option>
                <?php endforeach; ?>
            </select><br>

            <label for="stock_quantity">Stock Quantity:</label>
            <input type="number" id="stock_quantity" name="stock_quantity" value="<?php echo $product['stock_quantity']; ?>" min="0"><br>

            <label for="image_url1">Image 1:</label>
            <?php if (!empty($product['image_url1'])): ?>
                <img src="<?php echo $product['image_url1']; ?>" alt="Product Image 1" width="100"><br>
            <?php endif; ?>
            <input type="file" id="image1" name="image1" accept="image/*"><br>

            <label for="image_url2">Image 2:</label>
            <?php if (!empty($product['image_url2'])): ?>
                <img src="<?php echo $product['image_url2']; ?>" alt="Product Image 2" width="100"><br>
            <?php endif; ?>
            <input type="file" id="image2" name="image2" accept="image/*"><br>

            <input type="submit" name="submit" value="Update Product">
            <input type="submit" name="delete" value="Delete Product" onclick="return confirm('Are you sure you want to delete this product?');">
        </form>
    </main>
</body>
</html>
