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
        <img style="width:30%" src="qrcode.png" alt="QR Code">
    </div>
</body>

    <?php
        // Connect to the database
        $con = mysqli_connect("localhost", "root", "", "fkpark");
        if (!$con) {
            die('Could not connect: ' . mysqli_connect_error());
        }

        // Retrieve form data
        $date = $_POST['date'];
        $startTime = $_POST['startTime'];
        $endTime = $_POST['endTime'];
        $parkingSlotID = $_POST['parkingSpotID'];

        // Generate a QR code (this is a placeholder, implement your QR code generation logic)
        $qrCode = "QR_CODE_PLACEHOLDER";

        // Insert booking data into the booking table
        $query = "INSERT INTO booking (booking_date, booking_startTime, booking_endTime, booking_QRCode, parkingSlot_ID) 
                VALUES ('$date', '$startTime', '$endTime', '$qrCode', $parkingSlotID)";

        if (mysqli_query($con, $query)) {
            echo "Booking created successfully";
        } else {
            echo "Error: " . mysqli_error($con);
        }

        mysqli_close($con);
    ?>

</html>
