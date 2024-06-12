<?php
    session_start();

    if (!isset($_SESSION['userID'])) {
        header("Location: ../Manage Login/login.php"); // Redirect to the login page
        exit;
    }

    include '../DB_FKPark/dbh.php';

    $summon_id = $_GET['summon_id'];

    $query = "SELECT s.* ,v.*, st.*
              FROM summon s
              JOIN vehicle v ON s.vehicle_numPlate = v.vehicle_numPlate
              JOIN student st ON v.student_ID = st.student_ID
              WHERE s.summon_id = $summon_id";

    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($con));
    } else {
        $row = mysqli_fetch_assoc($result);

        $summon_ID = $row['summon_ID'];
        $summon_violation = $row['summon_violation'];
        $summon_datetime = $row['summon_datetime'];
        $summon_demerit = $row['summon_demerit'];
        $summon_location = $row['summon_location'];

        $vehicle_numPlate = $row['vehicle_numPlate'];
        $vehicle_type = $row['vehicle_type'];
        $vehicle_brand = $row['vehicle_brand'];
        $vehicle_transmission = $row['vehicle_transmission'];

        $student_username = $row['student_username'];
        $student_phoneNum = $row['student_phoneNum'];
        $student_demtot = $row['student_demtot'];

        $qrData = "Vehicle Number Plate: $vehicle_numPlate | DateTime: $summon_datetime | Violation: $summon_violation | Student: $student_username ";
        $qrDataEncoded = urlencode($qrData);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="QRBooking.css">
    <title>QR Code for Summons</title>
</head>
<body>
    <div class="qr-container">
        <h1>Your Summons QR Code</h1>
        <img style="width:30%" src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo $qrDataEncoded; ?>" alt="QR Code">
        <div id="bookingInfo" style="margin-top: 20px;">
            <p>Parking Slot: <?php echo $summon_violation; ?></p>
            <p>Date: <?php echo $vehicle_type; ?></p>
            <p>Start Time: <?php echo $student_username; ?></p>
            <p>End Time: <?php echo $student_phoneNum; ?></p>
        </div>
        <button type="button" class="back-button" onclick="confirmBack()">View booking</button>
    </div>
</body>

<script>
        function confirmBack() {
            window.location.href = 'viewBooking.php';
        }
</script>
</html>
