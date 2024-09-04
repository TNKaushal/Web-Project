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
$password = "Plus888@"; // Default XAMPP password is empty
$dbname = "vogue_ventures2"; // Replace with your actual database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle deletion
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Prepare and execute the deletion
    $stmt = $conn->prepare("DELETE FROM Products WHERE product_id = ?");
    $stmt->bind_param("i", $productId);

    if ($stmt->execute()) {
        echo "Product deleted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Redirect to the list products page
header("Location: list_products.php");

// Close the connection
$conn->close();
?>
