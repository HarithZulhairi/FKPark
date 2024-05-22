<?php
// config_all.php
// creation table and insert of sample records.

$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

mysqli_select_db($con, "fkpark") or die(mysqli_error($con));

// Now create the student table
$query5 = 'CREATE TABLE student( ' .
          'student_ID INT NOT NULL AUTO_INCREMENT, ' .
          'student_username VARCHAR(100) NOT NULL, ' .
          'student_password VARCHAR(100) NOT NULL, ' .
          'student_email VARCHAR(100) NOT NULL, ' .
          'student_age INT NOT NULL, ' .
          'student_demtot INT NOT NULL, ' .
          'administrator_ID INT, ' .
          'PRIMARY KEY(student_ID), ' .
          'FOREIGN KEY (administrator_ID) REFERENCES administrator(administrator_ID))';

if (mysqli_query($con, $query5)) {
    echo "<h3>Your student table has been created !!!</h3>";
} else {
    echo "<br>";
    echo "Error creating table: " . mysqli_error($con);
}
mysqli_close($con);
?>