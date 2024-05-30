<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="confirmBooking.css">
    <title>Parking Booking Form</title>
</head>
<body>
    <?php 
        include '../Layout/studentHeader.php'; 

        // Connect to the database
        $con = mysqli_connect("localhost", "root", "", "fkpark");
        if (!$con) {
            die('Could not connect: ' . mysqli_connect_error());
        }

        // Get the parking slot name from the query parameter
        $parkingSpot = htmlspecialchars($_GET['parkingSpot']);

        // Retrieve the parking slot ID based on the parking slot name
        $query = "SELECT parkingSlot_ID FROM parkingSlot WHERE parkingSlot_name='$parkingSpot'";
        $result = mysqli_query($con, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $parkingSlotID = $row['parkingSlot_ID'];
        } else {
            echo "Error retrieving parking slot ID: " . mysqli_error($con);
            $parkingSlotID = null;
        }

        mysqli_close($con);
    ?>

    <main>
        <div class="booking-form-container">
            <h1>Parking Booking Form</h1>
            <p style="text-align: center;">Parking Spot: <?php echo $parkingSpot; ?></p>
            <form action="QRBooking.php" method="POST">
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" required>
                </div>
                <div class="form-group">
                    <label for="startTime">Start Time:</label>
                    <input type="time" id="startTime" name="startTime" required>
                </div>
                <div class="form-group">
                    <label for="endTime">End Time:</label>
                    <input type="time" id="endTime" name="endTime" required>
                </div>
                <input type="hidden" id="parkingSpotID" name="parkingSpotID" value="<?php echo $parkingSlotID; ?>">
                <button type="submit" class="confirm-button">Confirm Booking</button>
            </form>
        </div>
    </main>

    <?php include '../Layout/allUserFooter.php'; ?>
</body>
</html>
