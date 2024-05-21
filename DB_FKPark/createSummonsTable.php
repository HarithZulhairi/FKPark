<?php
// config_all.php
// creation table and insert of sample records.

$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

mysqli_select_db($con, "fkpark") or die(mysqli_error($con));

// Create the summons table 
$query1 = 'CREATE TABLE summons( ' .
          'summons_ID INT NOT NULL AUTO_INCREMENT, ' .
          'summons_date DATE NOT NULL, ' .
          'summons_violation TIME NOT NULL, ' .
          'summons_demerit TIME NOT NULL, ' .
          'summons_QR VARCHAR(100) NOT NULL, ' .
          'uk_ID VARCHAR(255) NOT NULL, ' .
          'vehicle_numPlate VARCHAR(10), ' .
          'PRIMARY KEY(summons_ID))' .
          'FOREIGN KEY (uk_ID) REFERENCES Unitkeselamatanstaff(uk_ID))' . 
          'FOREIGN KEY (vehicle_numPlate) REFERENCES Vehicle(vehicle_numPlate))';

if (mysqli_query($con, $query1)) {
    echo "<h3>Your summons table has been created !!!</h3>";
} else {
    echo "<br>";
    echo "Error creating table: " . mysqli_error($con);
}

mysqli_close($con);
?>