<?php
// config_all.php
// creation of database, table and insert of sample records.

$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

mysqli_select_db($con, "fkpark") or die(mysqli_error($con));

// Now create the student table
$query6 = 'CREATE TABLE Student( ' .
          'student_ID INT NOT NULL AUTO_INCREMENT, ' .
          'student_username VARCHAR(100) NOT NULL, ' .
          'student_password VARCHAR(100) NOT NULL, ' .
          'student_email VARCHAR(100) NOT NULL, ' .
          'student_age INT NOT NULL, ' .
          'student_phoneNum VARCHAR(15) NOT NULL, ' .
          'student_gender VARCHAR(10) NOT NULL, ' .
          'student_demtot INT DEFAULT 0, ' .
          'student_birthdate DATE NOT NULL, ' .
          'student_profile VARCHAR(255) NOT NULL, ' .
          'student_demtot INT DEFAULT 0, ' .
          'PRIMARY KEY(student_ID)) ENGINE=InnoDB;';

if (mysqli_query($con, $query6)) {
    echo "<h3>Your student table has been created !!!</h3>";
} else {
    echo "<br>";
    echo "Error creating table: " . mysqli_error($con);
}
