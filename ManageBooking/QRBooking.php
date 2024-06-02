<?php
    session_start();

    if (!isset($_SESSION['userID'])) {
        header("Location: ../Manage Login/login.html");
        exit;
    }

    $studentID = $_SESSION['userID'];

    if (!isset($_GET['bookingID'])) {
        echo "No booking ID provided.";
        exit;
    }

    $bookingID = $_GET['bookingID'];

    $con = mysqli_connect("localhost", "root", "", "fkpark");
    if (!$con) {
        die('Could not connect: ' . mysqli_connect_error());
    }

    $query = "SELECT booking_QRCode FROM booking WHERE booking_ID = '$bookingID' AND student_ID = '$studentID'";
    $result = mysqli_query($con, $query);
    $booking = mysqli_fetch_assoc($result);

    if (!$booking) {
        echo "Booking not found or you do not have permission to view this booking.";
        exit;
    }

    $qrCode = $booking['booking_QRCode'];
    mysqli_close($con);
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
        <img style="width:30%" src="data:image/png;base64,<?php echo base64_encode($qrCode); ?>" alt="QR Code">
    </div>
</body>
</html>
