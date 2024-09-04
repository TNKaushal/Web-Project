
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

// Fetch data from the database
$totalProducts = 0;
$totalOrders = 0;
$totalCustomers = 0;

$sqlProducts = "SELECT COUNT(*) as total FROM Products";
$resultProducts = $conn->query($sqlProducts);
if ($resultProducts->num_rows > 0) {
    $row = $resultProducts->fetch_assoc();
    $totalProducts = $row['total'];
}

$sqlOrders = "SELECT COUNT(*) as total FROM Ordertest";
$resultOrders = $conn->query($sqlOrders);
if ($resultOrders->num_rows > 0) {
    $row = $resultOrders->fetch_assoc();
    $totalOrders = $row['total'];
}

$sqlCustomers = "SELECT COUNT(*) as total FROM c_details";
$resultCustomers = $conn->query($sqlCustomers);
if ($resultCustomers->num_rows > 0) {
    $row = $resultCustomers->fetch_assoc();
    $totalCustomers = $row['total'];
}

// Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Shoe Store</title>
    <link rel="stylesheet" href="admin.css">
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .admin-container {
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: ;
            color: #fff;
            padding: 20px;
        }
        .sidebar .menu {
            list-style: none;
            padding: 0;
        }
        .sidebar .menu li {
            margin: 10px 0;
        }
        .sidebar .menu li a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 4px;
        }
        .sidebar .menu li a:hover {
            background-color: #34495e;
        }
        .main-content {
            flex: 1;
            padding: 20px;
        }
        .card {
            background-color: #fff;
            padding: 10px;
            margin: 10px 0 20px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .card h3 {
            margin: 0 0 10px;
        }
        .card p {
            font-size: 24px;
            margin: 0;
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
        .overview-card {
            margin-top: 30px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .overview-card canvas {
            width: 100% !important;
            height: 400px;
        }
        .logo img {
            height: 40px;
        }
        
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
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

        <!-- Main Content -->
        <main class="main-content">
            <header>
                <h1>Dashboard</h1>
            </header>
            <section class="content">
                <!-- Dashboard content goes here -->
                <div class="card">
                    <h3>Total Products</h3>
                    <p><?php echo $totalProducts; ?></p>
                </div>
                <div class="card">
                    <h3>Total Orders</h3>
                    <p><?php echo $totalOrders; ?></p>
                </div>
                <div class="card">
                    <h3>Total Customers</h3>
                    <p><?php echo $totalCustomers; ?></p>
                </div>

                <!-- Bar Chart -->
                <div class="overview-card">
                    <h3>Overview</h3>
                    <canvas id="overviewBarChart"></canvas>
                </div>
            </section>
        </main>
    </div>

    <!-- Script to generate the bar chart -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('overviewBarChart').getContext('2d');
            var overviewBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Total Products', 'Total Orders', 'Total Customers'],
                    datasets: [{
                        label: 'Count',
                        data: [<?php echo $totalProducts; ?>, <?php echo $totalOrders; ?>, <?php echo $totalCustomers; ?>],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)', // Light teal
                            'rgba(153, 102, 255, 0.2)', // Light purple
                            'rgba(255, 159, 64, 0.2)'  // Light orange
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)', // Teal
                            'rgba(153, 102, 255, 1)', // Purple
                            'rgba(255, 159, 64, 1)'  // Orange
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    var label = context.label || '';
                                    var value = context.raw || 0;
                                    return label + ': ' + value;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
