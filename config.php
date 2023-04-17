<?php

/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'hpms123');
define('DB_NAME', 'HPMS');

/* Attempt to connect to MySQL database */
$con= mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ( mysqli_connect_errno() ) {
	// error catch if connection failure
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

//open MySQL connection
/*function OpenCon()
{
	$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if ($conn -> connect_errno) {
		echo "Failed to connect to MySQL: " . $conn -> connect_error;
        	exit();
	}

 	return $conn;
}*/

if (!function_exists('OpenCon')) {
    function OpenCon()
    {
            $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

            if ($conn -> connect_errno) {
                    echo "Failed to connect to MySQL: " . $conn -> connect_error;
                    exit();
            }

            return $conn;
    }
}

//close passed MySQL connection
/*function CloseCon($conn)
 {
 $conn -> close();
}*/

if (!function_exists('CloseCon')) {
    function CloseCon($conn)
    {
        $conn -> close();
    }
}

?>
