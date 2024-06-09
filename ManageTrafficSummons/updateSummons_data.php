<?php
    session_start();

    include '../DB_FKPark/dbh.php';


    if(isset($_POST['form_submitted'])){
        
        $up_veh_plate = $_POST['vehicleNumPlate'];
        $up_violation = $_POST['violation'];
        $up_location = $_POST['location'];
        $up_datetime = $_POST['datetime'];
        $summon_id = $_POST['summon_id'];

        $up_summon_demerit = 0;
        if($up_violation == "Speeding")
        {
            $up_summon_demerit = 10;
        } 
        else if ($up_violation === "Not Complying") {
            $up_summon_demerit = 15;
        } 
        else if ($up_violation === "Accident") {
            $up_summon_demerit = 20;
        } 


        if(!$up_veh_plate || !$up_violation || !$up_location || !$up_datetime){
            header('location:ManageSummons.php?message=You need to fill in the required information! ');
        }
        else{

            // Perform the database update for parking slot
            $query1 = "UPDATE `summon` SET  `vehicle_numPlate` = '$up_veh_plate',
                                            `summon_violation` = '$up_violation',
                                            `summon_location` = '$up_location',
                                            `summon_datetime` = '$up_datetime',
                                            `summon_demerit` = '$up_summon_demerit'
            WHERE `summon_ID` = '$summon_id'"; 

            $result = mysqli_query($con, $query1);
            if(!$result){
                die("Query failed: " . mysqli_error($con));
            }
            else{
                $_SESSION['up_message'] = "Your data has been updated successfully!";
                header('location:ManageSummons.php');
            }

        }


    } else{
        echo "Mak Kau Hijau";
    }

?>