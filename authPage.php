<html>
<head>
    <title>Unverified Users</title>
    <style>
        table {
          font-family: Arial, Helvetica, sans-serif;
          border-collapse: collapse;
          width: 70%;
          margin: 50px auto;
          background-color: #fff;
          box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
          border-radius: 10px;
        }

        td, th {
          border: none;
          padding: 10px;
        }

        tr:nth-child(even) {
          background-color: #f2f2f2;
        }

        tr:hover {
          background-color: #ddd;
        }

        th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          background-color: #0047AB;
          color: white;
          border-top-left-radius: 10px;
          border-top-right-radius: 10px;
        }

        h2{
          text-align: center;
          font-family: Arial, Helvetica, sans-serif;
          margin-top: 50px;
        }

        .btn {
          background-color: #555;
          border: none;
          border-radius: 4px;
          color: #fff;
          cursor: pointer;
          font-size: 16px;
          padding: 14px 20px;
          position: fixed;
          right: 20px;
          bottom: 20px;
          text-decoration: none;
          transition: all 0.3s ease-in-out;
        }

        .btn:hover {
          background-color: #333;
          transform: translateY(-2px);
        }

        .verify-btn {
                  display: inline-block;
                  background-color: #0047AB;
                  border: none;
                  border-radius: 4px;
                  color: white;
                  cursor: pointer;
                  font-size: 14px;
                  margin: 5px;
                  padding: 8px 14px;
                  text-align: center;
                  text-decoration: none;
                  transition: all 0.3s ease-in-out;
                }

                .verify-btn:hover {
                  background-color: #3e8e41;
                  transform: translateY(-2px);
                }


    </style>
</head>
<body>

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

// Retrieve all unverified users from the database
$sql = "SELECT * FROM users WHERE verified = false";
$result = mysqli_query($conn, $sql);

// Display the list of unverified users
echo "<h2>Admin Panel</h2>";
echo "<table>";
echo "<tr><th>Email</th><th>Password</th><th></th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
  echo "<tr>";
  echo "<td>" . $row['email'] . "</td>";
  echo "<td>" . $row['password'] . "</td>";
   echo "<td><a href='verify.php?id=" . $row['id'] . "' class='verify-btn'>Verify</a></td>";
  echo "</tr>";
}
echo "</table>";

// Close the database connection
mysqli_close($conn);
?>
<a href="login.html" class="btn btn-secondary">Return</a>
</body>
</html>
