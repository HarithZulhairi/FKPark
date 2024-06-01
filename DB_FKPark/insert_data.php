<?php
    include 'dbcon.php';
    //include '../phpqrcode/qrlib.php';

    if(isset($_POST['add_parking'])){
        
        $p_area = $_POST['p_area'];
        $p_status = $_POST['p_status'];

        if($p_area == "" || empty($p_area)){
            header('location:../ManageParkingArea/ManageParking.php?message=You need to fill in the parking area! ');
        }
        else{
             // QR code generation
            /*$path = '../resource';
            $qrimage = time() . ".png";
            $qrcode = $path . $qrimage;
            $qrtext = "Parking Area: " . $p_area;

            // Generate QR code
            QRcode::png($qrtext, $qrcode, 'H', 4, 4);*/

            $query = "INSERT INTO `parkingArea` (`parkingArea_name`, `parkingArea_status`) 
            VALUES ('$p_area', '$p_status')";

            $result = mysqli_query($con, $query);

            if(!$query){
                die("Query Failed" . mysqli_error());
            }

            else{
                header('location:../ManageParkingArea/ManageParking.php?message=You data has been added successfully!&qr_image=' . $qrimage);
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
        $p_area = $_POST['p_area'];

        if($event_name == "" || empty($event_name)){
            header('location:../ManageParkingArea/ManageParking.php?message=You need to fill in the event detail! ');
        }

    }

?>