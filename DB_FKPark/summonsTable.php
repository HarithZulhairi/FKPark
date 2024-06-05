<?php
// config_all.php
// creation of database, table and insert of sample records.

$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

mysqli_select_db($con, "fkpark") or die(mysqli_error($con));

// Create the summons table 
$query9 = 'CREATE TABLE summon( ' .
          'summon_ID INT NOT NULL AUTO_INCREMENT, ' .
          'summon_datetime DATETIME NOT NULL, ' .
          'summon_violation VARCHAR(30) NOT NULL, ' .
          'summon_demerit INT NOT NULL, ' .
          'summon_location VARCHAR(100) NOT NULL, ' .
          'summon_QR VARCHAR(255), ' .
          'uk_ID INT NOT NULL, ' .
          'vehicle_numPlate VARCHAR(10) NOT NULL, ' .
          'PRIMARY KEY(summon_ID), ' .
          'FOREIGN KEY (uk_ID) REFERENCES unitKeselamatanStaff(uk_ID), ' . 
          'FOREIGN KEY (vehicle_numPlate) REFERENCES Vehicle(vehicle_numPlate)' .
          ')';

if (mysqli_query($con, $query9)) {
    echo "<h3>Your summon table has been created !!!</h3>";
} else {
    echo "<br>";
    echo "Error creating table: " . mysqli_error($con);
}


mysqli_close($con);
?>