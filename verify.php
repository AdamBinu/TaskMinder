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

// Get the user ID from the URL parameter
$user_id = $_GET['id'];

// Update the verification status in the database
$sql = "UPDATE users SET verified = true WHERE id = $user_id";
if (mysqli_query($conn, $sql)) {
  echo "<script>alert('User Verified.'); setTimeout(function() { window.location.href='authPage.php';},1000);</script>";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
