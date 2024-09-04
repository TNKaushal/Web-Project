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

// Fetch all products with category names from the database
$sqlProducts = "SELECT p.*, c.category_name 
                FROM products p 
                JOIN categories c ON p.Category_id = c.Category_id"; // Ensure correct table names
$resultProducts = $conn->query($sqlProducts);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Products - Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        @font-face {
            font-family: 'Jost';
            src: url('fonts/Jost-VariableFont_wght.ttf') format('truetype');
            font-weight: 100 900; 
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid #ccc; 
            font-family: 'Jost', sans-serif;
        }
        table th, table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
            font-family: 'Jost', sans-serif;
        }
        table th {
            background-color: #f2f2f2;
            color: #000;
            font-family: 'Jost', sans-serif;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            text-align: center;
            font-size: 16px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .logo img {
            height: 40px;
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
                <h1>List Products</h1>
            </header>
            <section class="content">
                <table>
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($resultProducts->num_rows > 0): ?>
                            <?php while ($row = $resultProducts->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['product_id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['category_name']; ?></td> <!-- Display category name -->
                                    <td><?php echo $row['price']; ?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td>
                                        <a href="edit_product.php?id=<?php echo $row['product_id']; ?>" class="btn">Edit</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No products found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
