<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "guvi";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$password = $_POST['password'];

// Check if the username already exists
$check_query = "SELECT * FROM users WHERE name = '$name'";
$result = mysqli_query($conn, $check_query);
if (mysqli_num_rows($result) > 0) {
    // If the username already exists, display an error message
    $response = array(
        'success' => false,
        'message' => 'Username already exists'
    );
} else {
    // If the username doesn't exist, insert a new user record
    $stmt = $conn->prepare("INSERT INTO users (name, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $password);

    if ($stmt->execute()) {
        $response = array(
            'success' => true,
            'message' => 'Registration successful'
        );
    } else {
        $response = array(
            'success' => false,
            'message' => 'Error: ' . $stmt->error
        );
    }

    $stmt->close();
}

$conn->close();

// Return response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
