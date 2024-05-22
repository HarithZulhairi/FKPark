<?php
// Connect to the database
$con = mysqli_connect("localhost", "root") or die(mysqli_connect_error());
mysqli_select_db($con, "fkpark") or die(mysqli_error());

// Insert data into the event table
$query3 = "INSERT INTO event (event_name, event_date, event_startTime, event_endTime, event_place, event_description) VALUES 
('JAMUAN RAYA', '2005-12-04', '12:00:00', '13:00:00', 'FKOM', 'MAKAN'), 
('MENTOR MENTEE', '2005-07-18', '22:00:00', '23:00:00', 'ASTKAK', 'DISCUSSION')";

$result1 = mysqli_query($con, $query3);

if ($result1) {
    echo "Events inserted successfully<br>";
} else {
    echo "Error inserting events: " . mysqli_error($con) . "<br>";
}

// Retrieve the event_IDs for the newly inserted events
$query_get_event1_id = "SELECT event_ID FROM event WHERE event_name='JAMUAN RAYA'";
$query_get_event2_id = "SELECT event_ID FROM event WHERE event_name='MENTOR MENTEE'";

$result_event1_id = mysqli_query($con, $query_get_event1_id);
$result_event2_id = mysqli_query($con, $query_get_event2_id);

$event1_id = mysqli_fetch_assoc($result_event1_id)['event_ID'];
$event2_id = mysqli_fetch_assoc($result_event2_id)['event_ID'];

// Prepare the base query
$query4 = "INSERT INTO parking (parking_area, parking_status, parking_availability, event_ID) VALUES 
('A1', 'UNAVAILABLE', 12, $event1_id), 
('A2', 'AVAILABLE', 18,  $event2_id)";

$result2 = mysqli_query($con, $query4);

// Check whether the inserts were successful
if ($result2) {
    echo "Parking data inserted successfully";
} else {
    echo "Error inserting parking data: " . mysqli_error($con);
}
?>
