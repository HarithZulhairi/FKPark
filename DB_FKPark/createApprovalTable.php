<?php
// config_all.php
// creation table and insert of sample records.

$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

mysqli_select_db($con, "fkpark") or die(mysqli_error($con));

// Now create the registration table
$query1 = 'CREATE TABLE approval( ' .
          'approval_ID INT NOT NULL AUTO_INCREMENT, ' .
          'vehicle_grant VARCHAR(100) NOT NULL, ' .
          'approval_status VARCHAR(10) NOT NULL, ' .
          'student_ID INT, ' .
          'PRIMARY KEY(approval_ID), ' .
          'FOREIGN KEY (student_ID) REFERENCES student(student_ID))';

if (mysqli_query($con, $query1)) {
    echo "<h3>Your registration table has been created !!!</h3>";
} else {
    echo "<br>";
    echo "Error creating table: " . mysqli_error($con);
}

mysqli_close($con);
?>