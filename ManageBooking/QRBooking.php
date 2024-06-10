<?php
    session_start();

    if (!isset($_SESSION['userID']) || !isset($_GET['parkingSlotName']) || !isset($_GET['bookingDate']) || !isset($_GET['startTime']) || !isset($_GET['endTime'])) {
        header("Location: ../Manage Login/login.php"); // Redirect to the login page
        exit;
    }

    $parkingSlotName = $_GET['parkingSlotName'];
    $bookingDate = $_GET['bookingDate'];
    $startTime = $_GET['startTime'];
    $endTime = $_GET['endTime'];

    $qrData = "Parking Slot: $parkingSlotName | Date: $bookingDate | Start Time: $startTime | End Time: $endTime";
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
            <p>Parking Slot: <?php echo $parkingSlotName; ?></p>
            <p>Date: <?php echo $bookingDate; ?></p>
            <p>Start Time: <?php echo $startTime; ?></p>
            <p>End Time: <?php echo $endTime; ?></p>
        </div>
        <button type="button" class="back-button" onclick="confirmBack()">Back</button>
    </div>
</body>

<script>
        function confirmBack() {
            window.history.back();
        }
</script>
</html>

