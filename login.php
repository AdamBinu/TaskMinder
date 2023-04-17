<?php
// Start the session
session_start();

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

// Check if the user exists in the database
$pass=md5($password);
$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$pass'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  if ($row['verified']) {
    // Set session variables and redirect to the home page
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['email'] = $row['email'];
    header("Location: dashboard.php");
  } else {
    echo "<script>alert('Your Account has Not been verified Yet'); setTimeout(function() { window.location.href='login.html';},1000);</script>";
  }
} else {
echo "<script>alert('Invalid Email or Password'); setTimeout(function() { window.location.href='login.html';},1000);</script>";
}

// Close the database connection
mysqli_close($conn);
?>
