<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "hpms123";
$dbname = "HPMS";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get the form data
$email = $_POST['email'];
$password = $_POST['password'];

// Validate the input
if (empty($email) || empty($password)) {
  die("Email and password are required.");
}

// Insert the new user into the database with verification status set to false
$pass=md5($password);
$sql = "INSERT INTO users (email, password, verified) VALUES ('$email', '$pass', false)";
if (mysqli_query($conn, $sql)) {
  echo "<script>alert('Account Succesfully Made. Please await Verification from Admin'); setTimeout(function() { window.location.href='login.html';},1000);</script>";
} else {
  echo ' Please Check Your Query ';
}

// Close the database connection
mysqli_close($conn);
?>
