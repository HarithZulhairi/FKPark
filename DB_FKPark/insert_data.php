<?php

    if(isset($_POST['add_parking'])){
        
        $p_area = $_POST['p_area'];
        $p_availability = $_POST['p_availability'];
        $p_status = $_POST['p_status'];

        if($p_area == "" || empty($p_area)){
            header('location:../ManageParkingArea/ManageParking.php?message=You need to fill in the parking area! ');
        }
        else{
            
        }


    }

    if(isset($_POST['add_event'])){
        
        $event_name = $_POST['event_name'];
        $event_date = $_POST['event_date'];
        $event_start = $_POST['event_start'];
        $event_end = $_POST['event_end'];
        $event_place = $_POST['event_place'];
        $event_description = $_POST['event_description'];

        if($event_name == "" || empty($event_name)){
            header('location:../ManageParkingArea/ManageParking.php?message=You need to fill in the event detail! ');
        }

    }

?>