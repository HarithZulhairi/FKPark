<?php
    session_start();

    include '../DB_FKPark/dbh.php';


    if(isset($_GET['summon_ID'])){
        $summon_id = $_GET['summon_ID']; // Get the id from the URL.
    

        $query = "delete from `summon` where `summon_ID` = '$summon_id'";

        $result = mysqli_query($con, $query);

        if(!$result){
            die("Query Failed".mysqli_error());
        }
        else{
            $_SESSION['del_message'] = "Your data has been deleted successfully!";
            header('location:ManageSummons.php');
            exit();
        }
    }
    else{
        echo "Mak Kau Hijau";
    }

?>