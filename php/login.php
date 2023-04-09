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

// Check if the username and password are correct
$stmt = $conn->prepare("SELECT * FROM users WHERE name = ? AND password = ?");
$stmt->bind_param("ss", $name, $password);
$stmt->execute();
$result = $stmt->get_result();
$row=$result->fetch_assoc();

if ($result->num_rows == 0) {
  echo json_encode(array(
    'success'=>false,
    'message'=>"Invalid credentials"
  ));
} else {
  $userid=$row['id'];
  $username=$row['name'];
  echo json_encode(array(
    'success' => true,
    'userid' => $userid,
    'username'=> $username,
    'message'=>"Logged in successfully"
  ));
}


$stmt->close();
$conn->close();

?>