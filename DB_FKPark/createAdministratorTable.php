<?php
// config_all.php
// creation table and insert of sample records.

$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

mysqli_select_db($con, "fkpark") or die(mysqli_error($con));

// Now create the administrator table
$query1 = 'CREATE TABLE Administrator( ' .
          'administrator_ID INT NOT NULL AUTO_INCREMENT, ' .
          'administrator_username VARCHAR(100) NOT NULL, ' .
          'administrator_password VARCHAR(100) NOT NULL, ' .
          'administrator_email VARCHAR(100) NOT NULL, ' .
          'administrator_age INT NOT NULL, ' .
          'PRIMARY KEY(administrator_ID))';

if (mysqli_query($con, $query1)) {
    echo "<h3>Your administrator table has been created !!!</h3>";
} else {
    echo "<br>";
    echo "Error creating table: " . mysqli_error($con);
}

mysqli_close($con);
?>