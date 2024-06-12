<?php
// Connect to your database
$con = mysqli_connect("hostname", "username", "password", "fkpark");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$data_id = $_GET['data_id'];

$query = "SELECT s.summon_ID, s.vehicle_numPlate, s.summon_violation FROM summon s WHERE s.summon_ID = $data_id";
$result = mysqli_query($con, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    echo "Summon ID: " . $row['summon_ID'] . "|Vehicle Plate: " . $row['vehicle_numPlate'] . "|Violat: " . $row['summon_violation'];
} else {
    echo "No data found.";
}

mysqli_close($con);
?>