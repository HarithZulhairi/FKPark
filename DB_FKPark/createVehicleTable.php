<?php
// config_all.php
// creation table and insert of sample records.

$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

mysqli_select_db($con, "fkpark") or die(mysqli_error($con));

// Now create the vehicle table
$query1 = 'CREATE TABLE Vehicle( ' .
          'vehicle_numPlate VARCHAR(10) NOT NULL, ' .
          'vehicle_type VARCHAR(20) NOT NULL, ' .
          'vehicle_brand VARCHAR(50) NOT NULL, ' .
          'vehicle_transmission VARCHAR(20) NOT NULL, ' .
          'student_ID INT, ' .
          'PRIMARY KEY(vehicle_numPlate), ' .
          'FOREIGN KEY (student_ID) REFERENCES student(student_ID))';

if (mysqli_query($con, $query1)) {
    echo "<h3>Your vehicle table has been created !!!</h3>";
} else {
    echo "<br>";
    echo "Error creating table: " . mysqli_error($con);
}

mysqli_close($con);
?>