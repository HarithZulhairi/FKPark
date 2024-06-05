<?php
include '../DB_FKPark/dbcon.php';

if (isset($_POST['vehicleNumPlate'])) {
    $vehicleNumPlate = $_POST['vehicleNumPlate'];

    $query = "SELECT * FROM vehicle WHERE vehicle_numPlate = '$vehicleNumPlate'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "exists";
    } else {
        echo "not exists";
    }
}
?>