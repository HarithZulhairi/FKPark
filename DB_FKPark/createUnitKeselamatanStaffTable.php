<?php
// config_all.php
// creation table and insert of sample records.

$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

mysqli_select_db($con, "fkpark") or die(mysqli_error($con));

// Now create the unitkeselamatanstaff table with the foreign key
$query1 = 'CREATE TABLE UnitKeselamatanStaff( ' .
          'uk_ID VARCHAR(10) NOT NULL AUTO_INCREMENT, ' .
          'uk_username VARCHAR(100) NOT NULL, ' .
          'uk_password VARCHAR(100) NOT NULL, ' .
          'uk_email VARCHAR(100) NOT NULL, ' .
          'uk_age NUMBER NOT NULL, ' .
          'PRIMARY KEY(uk_ID), ' ;


if (mysqli_query($con, $query1)) {
    echo "<h3>Your unitkeselamatanstaff table has been created !!!</h3>";
} else {
    echo "<br>";
    echo "Error creating table: " . mysqli_error($con);
}

mysqli_close($con);
?>