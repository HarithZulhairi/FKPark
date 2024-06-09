<?php
    session_start();

    include '../DB_FKPark/dbh.php';


    if(isset($_POST['form_submitted'])){
        
        $veh_plate = $_POST['vehicleNumPlate'];
        $violation = $_POST['violation'];
        $location = $_POST['location'];
        $datetime = $_POST['datetime'];

        $summon_demerit = 0;
        if($violation == "Speeding")
        {
            $summon_demerit = 10;
        } 
        else if ($violation === "Not Complying") {
            $summon_demerit = 15;
        } 
        else if ($violation === "Accident") {
            $summon_demerit = 20;
        } 

        $ukID = isset($_SESSION['userID']) ? $_SESSION['userID'] : null;
        if ($ukID === null) {
            die('Unit Keselamatan Staff ID not found in session. Please login again.');
        }


        if(!$veh_plate || !$violation || !$location || !$datetime){
            header('location:ManageSummons.php?message=You need to fill in the required information! ');
        }
        else{

            $query = "INSERT INTO `summon` (`vehicle_numPlate`, `summon_violation`, `summon_datetime`, `summon_location`, `summon_demerit`, `uk_ID`) 
            VALUES ('$veh_plate', '$violation', '$datetime', '$location', '$summon_demerit' , '$ukID' )";

            $result = mysqli_query($con, $query);

            if(!$result){
                die("Query Failed" . mysqli_error());
            }
            else{
                $_SESSION['message'] = "Your data has been added successfully!";
                header('location:ManageSummons.php');
            }
            
        }


    } else{
        echo "Mak Kau Hijau";
    }


?>