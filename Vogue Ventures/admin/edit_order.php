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
$password = ""; // Replace with your actual password
$dbname = "vogue_ventures2"; // Replace with your actual database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $orderId = intval($_GET['id']);

    // Fetch the order details
    $sqlOrder = "SELECT * FROM orders WHERE order_id = $orderId";
    $resultOrder = $conn->query($sqlOrder);
    $order = $resultOrder->fetch_assoc();
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $customerId = intval($_POST['customer_id']);
        $orderDate = $_POST['order_date'];
        $totalAmount = floatval($_POST['total_amount']);
        $status = $_POST['status'];

        // Update the order details
        $sqlUpdate = "UPDATE orders SET customer_id = $customerId, order_date = '$orderDate', total_amount = $totalAmount, status = '$status' WHERE order_id = $orderId";
        if ($conn->query($sqlUpdate) === TRUE) {
            header("Location: orders.php");
            exit;
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
} else {
    echo "Order ID not specified.";
    exit;
}

// Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order - Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
    <style>
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
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
    </style>
</head>
<body>
    <div class="admin-container">
        <aside class="sidebar">
            <!-- Sidebar content here -->
        </aside>

        <main class="main-content">
            <header>
                <h1>Edit Order</h1>
                <a href="orders.php" class="btn">Back to Orders</a>
            </header>
            <section class="content">
                <form method="POST">
                    <div class="form-group">
                        <label for="customer_id">Customer ID</label>
                        <input type="number" id="customer_id" name="customer_id" value="<?php echo $order['customer_id']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="order_date">Order Date</label>
                        <input type="datetime-local" id="order_date" name="order_date" value="<?php echo date('Y-m-d\TH:i', strtotime($order['order_date'])); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="total_amount">Total Amount</label>
                        <input type="number" id="total_amount" name="total_amount" step="0.01" value="<?php echo $order['total_amount']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" required>
                            <option value="Pending" <?php if ($order['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                            <option value="Processing" <?php if ($order['status'] == 'Processing') echo 'selected'; ?>>Processing</option>
                            <option value="Completed" <?php if ($order['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                            <option value="Cancelled" <?php if ($order['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn">Update Order</button>
                </form>
            </section>
        </main>
    </div>
</body>
</html>
