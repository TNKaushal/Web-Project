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

// Fetch customers data from the database
$sqlCustomers = "SELECT * FROM c_details";
$resultCustomers = $conn->query($sqlCustomers);

// Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers - Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
            color: #000;
        }
        th {
            background-color: #f4f4f4;
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
                <h1>Customers</h1>
            </header>
            <section class="content">
                <table>
                    <thead>
                        <tr>
                            <th>Customer ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($resultCustomers->num_rows > 0): ?>
                            <?php while ($row = $resultCustomers->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['cid']; ?></td>
                                    <td><?php echo $row['c_name']; ?></td>
                                    <td><?php echo $row['c_email']; ?></td>
                                    <td>
                                        <a href="edit_customer.php?id=<?php echo $row['cid']; ?>" class="btn">Edit</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">No customers found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>
