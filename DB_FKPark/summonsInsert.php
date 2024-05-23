<?php

// Connect to the database
$con = mysqli_connect("localhost", "root") or die(mysqli_connect_error());
mysqli_select_db($con, "fkpark") or die(mysqli_error($con));

// Insert data into the event table
$query1 = "INSERT INTO summons (summons_date,  summons_violation, summons_demerit, summons_QR, uk_ID, vehicle_numPlate) VALUES 
('2024-05-24', 'Parking Violation', 10, '#', 1, 'XYZ456'), 
('2024-03-18', 'Not Complying', 15, '#', 2, 'BWF3456'),
('2024-02-24', 'Causing Accident', 20, '#', 2, 'CHS2345')";

$result1 = mysqli_query($con, $query1);

if ($result1) {
    echo "Summons inserted successfully<br>";
} else {
    echo "Error inserting events: " . mysqli_error($con) . "<br>";
}