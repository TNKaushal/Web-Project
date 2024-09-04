<?php
$servername = "localhost";
$username = "root";
$password = "";
$port = 3306;
$dbname = "vogue_ventures2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
