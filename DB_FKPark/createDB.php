<?php
// config_all.php
// creation of database, table and insert of sample records.

$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}
if (mysqli_query($con, "CREATE DATABASE fkpark")) {
    echo "<br><br>";
    echo "<h3>Your database has been created !!!</h3>";
} else {
    echo "Error creating database: " . mysqli_error($con);
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
          'parking_QRCode VARCHAR(255) NOT NULL, ' .
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


mysqli_close($con);
?>
