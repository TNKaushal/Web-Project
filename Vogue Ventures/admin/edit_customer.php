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

if (isset($_GET['id'])) {
    $customerId = intval($_GET['id']);

    // Fetch the customer details
    $sqlCustomer = "SELECT * FROM c_details WHERE cid = $customerId";
    $resultCustomer = $conn->query($sqlCustomer);
    $customer = $resultCustomer->fetch_assoc();
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $first_name = $_POST['c_name'];
        $email = $_POST['c_email'];

        // Update the customer details
        $sqlUpdate = "UPDATE c_details SET 
                        c_name = '$first_name', 
                        c_email = '$email', 
                      WHERE cid = $customerId";
                      
        if ($conn->query($sqlUpdate) === TRUE) {
            header("Location: customers.php");
            exit;
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
} else {
    echo "Customer ID not specified.";
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
    <title>Edit Customer - Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
    <style>
        .form-group {
            width: 100%;
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group textarea {
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
                <h1>Edit Customer</h1>
                <a href="customers.php" class="btn">Back to Customers</a>
            </header>
            <section class="content">
                <form method="POST">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($customer['c_name']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($customer['c_email']); ?>" required>
                    </div>

                    <button type="submit" class="btn">Update Customer</button>
                </form>
            </section>
        </main>
    </div>
</body>
</html>
