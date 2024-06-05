<?php 

define("HOSTNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE", "fkpark");

$con = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE);

if(!$con){
    die("Connection failed: ");
}

// Fetch event names
$eventQuery = "SELECT event_name FROM event";
$eventResult = mysqli_query($con, $eventQuery);

if (mysqli_num_rows($eventResult) > 0) {
    $events = mysqli_fetch_all($eventResult, MYSQLI_ASSOC);
} else {
    $events = [];
}

?>