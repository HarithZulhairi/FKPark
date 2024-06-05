<?php
include 'dbcon.php';
//include '../phpqrcode/qrlib.php';

if(isset($_POST['add_parking'])){
    
    $p_area = $_POST['p_area'];
    $p_status = $_POST['p_status'];
    $event_name = $_POST['event_name'];

    if($p_area == "" || empty($p_area)){
        header('location:../ManageParkingArea/ManageParking.php?message=You need to fill in the parking area! ');
    }
    else{
        // Fetch event_ID based on event_name
        $eventQuery = "SELECT event_ID FROM event WHERE event_name = '$event_name'";
        $eventResult = mysqli_query($con, $eventQuery);
        if($eventResult && mysqli_num_rows($eventResult) > 0){
            $eventRow = mysqli_fetch_assoc($eventResult);
            $event_ID = $eventRow['event_ID'];

            // QR code generation
            /*$path = '../resource';
            $qrimage = time() . ".png";
            $qrcode = $path . $qrimage;
            $qrtext = "Parking Area: " . $p_area;

            // Generate QR code
            QRcode::png($qrtext, $qrcode, 'H', 4, 4);*/

            $query = "INSERT INTO `parkingArea` (`parkingArea_name`, `parkingArea_status`, `event_ID`) 
            VALUES ('$p_area', '$p_status', '$event_ID')";

            $result = mysqli_query($con, $query);

            if(!$result){
                die("Query Failed" . mysqli_error($con));
            }
            else{
                header('location:../ManageParkingArea/ManageParking.php?message=You data has been added successfully!&qr_image=' . $qrimage);
            }
        } else {
            die("Event not found: " . mysqli_error($con));
        }
    }
}

if(isset($_POST['add_event'])){
    
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $event_start = $_POST['event_start'];
    $event_end = $_POST['event_end'];
    $event_place = $_POST['event_place'];
    $event_description = $_POST['event_description'];

    $query1 = "INSERT INTO `event` (`event_name`, `event_date`, `event_startTime`, `event_endTime`, `event_place`, `event_description`) 
    VALUES ('$event_name', '$event_date', '$event_start', '$event_end','$event_place','$event_description')";

    $result = mysqli_query($con, $query1);

    if(!$result){
        die("Query Failed" . mysqli_error($con));
    }
    else{
        header('location:../ManageParkingArea/ManageParking.php?message=You event data has been added successfully!');
    }

    //if($event_name == "" || empty($event_name)){
    //  header('location:../ManageParkingArea/ManageParking.php?message=You need to fill in the event detail! ');
    //}

}
?>
