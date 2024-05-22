<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CreateSummons.css">
    <title>Parking Booking Form</title>
</head>
<body>
    <?php include '../Layout/UKHeader.php'; ?>

    <main>
        <div class="booking-form-container">
            <h1>Parking Booking Form</h1>
            <p style="text-align: center;">Parking Spot: <?php echo htmlspecialchars($_GET['parkingSpot']); ?></p>
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
                <input type="hidden" id="parkingSpot" name="parkingSpot" value="<?php echo htmlspecialchars($_GET['parkingSpot']); ?>">
                <button type="submit" class="confirm-button">Confirm Booking</button>
            </form>
        </div>
    </main>

    <?php include '../Layout/allUserFooter.php'; ?>
</body>
</html>