<?php
// config_all.php
// creation of database, table and insert of sample records.

$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

mysqli_select_db($con, "fkpark") or die(mysqli_error($con));

// Create the event table first
$query1 = 'CREATE TABLE event( ' .
          'event_ID INT NOT NULL AUTO_INCREMENT, ' .
          'event_name VARCHAR(100) NOT NULL, ' .
          'event_date DATE NOT NULL, ' .
          'event_startTime TIME NOT NULL, ' .
          'event_endTime TIME NOT NULL, ' .
          'event_place VARCHAR(100) NOT NULL, ' .
          'event_description VARCHAR(255) NOT NULL, ' .
          'PRIMARY KEY(event_ID))';

if (mysqli_query($con, $query1)) {
    echo "<h3>Your event table has been created !!!</h3>";
} else {
    echo "<br>";
    echo "Error creating table: " . mysqli_error($con);
}

// Now create the parking table with the foreign key
$query2 = 'CREATE TABLE parking( ' .
          'parking_ID INT NOT NULL AUTO_INCREMENT, ' .
          'parking_area VARCHAR(100) NOT NULL, ' .
          'parking_status VARCHAR(100) NOT NULL, ' .
          'parking_availability INT NOT NULL, ' .
          'event_ID INT, ' .
          'PRIMARY KEY(parking_ID), ' .
          'FOREIGN KEY (event_ID) REFERENCES event(event_ID))';

if (mysqli_query($con, $query2)) {
    echo "<h3>Your parking table has been created !!!</h3>";
} else {
    echo "<br>";
    echo "Error creating table: " . mysqli_error($con);
}

// Now create the parking table with the foreign key
$query3 = 'CREATE TABLE booking( ' .
          'booking_ID INT NOT NULL AUTO_INCREMENT, ' .
          'booking_startTime TIME NOT NULL, ' .
          'booking_endTime TIME NOT NULL, ' .
          'booking_date DATE NOT NULL, ' .
          'booking_QRCode VARCHAR(255) NOT NULL, ' .
          'parking_ID INT, ' .
          'PRIMARY KEY(booking_ID), ' .
          'FOREIGN KEY (parking_ID) REFERENCES parking(parking_ID))';

if (mysqli_query($con, $query3)) {
    echo "<h3>Your booking table has been created !!!</h3>";
} else {
    echo "<br>";
    echo "Error creating table: " . mysqli_error($con);
}

// Now create the registration table with the foreign key
$query4 = 'CREATE TABLE Registration( ' .
          'registration_ID VARCHAR(10) NOT NULL AUTO_INCREMENT, ' .
          'vehicle_grant VARCHAR(100) NOT NULL, ' .
          'registration_status VARCHAR(10) NOT NULL, ' .
          'PRIMARY KEY(registration_ID), ' .
          'FOREIGN KEY (administrator_ID) REFERENCES administrator(administrator_ID))';
          'FOREIGN KEY (student_ID) REFERENCES student(student_ID))';


if (mysqli_query($con, $query3)) {
    echo "<h3>Your registration table has been created !!!</h3>";
} else {
    echo "<br>";
    echo "Error creating table: " . mysqli_error($con);
}

// Now create the vehicle table with the foreign key
$query5 = 'CREATE TABLE Vehicle( ' .
          'vehicle_numPlate VARCHAR(10) NOT NULL, ' .
          'vehicle_type VARCHAR(20) NOT NULL, ' .
          'vehicle_brand VARCHAR(50) NOT NULL, ' .
          'vehicle_transmission VARCHAR(20) NOT NULL, ' .
          'PRIMARY KEY(vehicle_numPlate), ' .
          'FOREIGN KEY (student_ID) REFERENCES student(student_ID))';


if (mysqli_query($con, $query3)) {
    echo "<h3>Your vehicle table has been created !!!</h3>";
} else {
    echo "<br>";
    echo "Error creating table: " . mysqli_error($con);
}

// Now create the student table with the foreign key
$query6 = 'CREATE TABLE Student( ' .
          'student_ID VARCHAR(10) NOT NULL AUTO_INCREMENT, ' .
          'student_username VARCHAR(100) NOT NULL, ' .
          'student_password VARCHAR(100) NOT NULL, ' .
          'student_email VARCHAR(100) NOT NULL, ' .
          'student_age NUMBER NOT NULL, ' .
          'student_demtot NUMBER NOT NULL, ' .
          'PRIMARY KEY(student_ID), ' .
          'FOREIGN KEY (administrator_ID) REFERENCES administrator(administrator_ID))';


if (mysqli_query($con, $query3)) {
    echo "<h3>Your student table has been created !!!</h3>";
} else {
    echo "<br>";
    echo "Error creating table: " . mysqli_error($con);
}

// Now create the administrator table with the foreign key
$query7 = 'CREATE TABLE Administrator( ' .
          'administrator_ID VARCHAR(10) NOT NULL AUTO_INCREMENT, ' .
          'administrator_username VARCHAR(100) NOT NULL, ' .
          'administrator_password VARCHAR(100) NOT NULL, ' .
          'administrator_email VARCHAR(100) NOT NULL, ' .
          'administrator_age NUMBER NOT NULL, ' .
          'PRIMARY KEY(administrator_ID), ' ;


if (mysqli_query($con, $query3)) {
    echo "<h3>Your administrator table has been created !!!</h3>";
} else {
    echo "<br>";
    echo "Error creating table: " . mysqli_error($con);
}

// Now create the unitkeselamatanstaff table with the foreign key
$query8 = 'CREATE TABLE UnitKeselamatanStaff( ' .
          'uk_ID VARCHAR(10) NOT NULL AUTO_INCREMENT, ' .
          'uk_username VARCHAR(100) NOT NULL, ' .
          'uk_password VARCHAR(100) NOT NULL, ' .
          'uk_email VARCHAR(100) NOT NULL, ' .
          'uk_age NUMBER NOT NULL, ' .
          'PRIMARY KEY(uk_ID), ' ;


if (mysqli_query($con, $query3)) {
    echo "<h3>Your unitkeselamatanstaff table has been created !!!</h3>";
} else {
    echo "<br>";
    echo "Error creating table: " . mysqli_error($con);
}



mysqli_close($con);
?>
