<?php
    session_start();

    $con = mysqli_connect("localhost", "root", "", "fkpark");
    if (!$con) {
        die('Could not connect: ' . mysqli_connect_error());
    }

    if (!isset($_SESSION['userID'])) {
        header("Location: ../Manage Login/login.php"); // Redirect to the login page
        exit;
    }

    $parkingSlotName = $_GET['parkingSlotName'];
    $bookingDate = $_GET['bookingDate'];
    $startTime = $_GET['startTime'];
    $endTime = $_GET['endTime'];
    $studentID = $_SESSION['userID'];

    $queryApp = "SELECT vehicle_grant FROM approval WHERE student_ID = '$studentID'";
    $resultApp = mysqli_query($con, $queryApp);

    if ($resultApp) {
        $row = mysqli_fetch_assoc($resultApp);
        $noplate = implode(", ",$row);
    }

    $qrData = "No plate: $noplate | Parking Slot: $parkingSlotName | Date: $bookingDate | Start Time: $startTime | End Time: $endTime";
    $qrDataEncoded = urlencode($qrData);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="QRBooking.css">
    <title>QR Code for Booking</title>
</head>
<body>
    <div class="qr-container">
        <h1>Your Booking QR Code</h1>
        <img style="width:30%" src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo $qrDataEncoded; ?>" alt="QR Code">
        <div id="bookingInfo" style="margin-top: 20px;">
            <b>No plate: <?php echo $noplate; ?></b>
            <p>Parking Slot: <?php echo $parkingSlotName; ?></p>
            <p>Date: <?php echo $bookingDate; ?></p>
            <p>Start Time: <?php echo $startTime; ?></p>
            <p>End Time: <?php echo $endTime; ?></p>     
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

