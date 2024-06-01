<?php
// Start output buffering
session_start();
ob_start();

// Check if the student ID is set in the session
if (!isset($_SESSION['userID'])) {
    // Redirect the user to the login page or display an error message
    header("Location: ../Manage Login/login.html");
    exit;
}

// Now you can safely use $_SESSION['student_ID'] in your code
$studentID = $_SESSION['userID'];
?>

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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $date = $_POST['date'];
            $startTime = $_POST['startTime'];
            $endTime = $_POST['endTime'];

            // Calculate booking duration
            $startDateTime = new DateTime($date . ' ' . $startTime);
            $endDateTime = new DateTime($date . ' ' . $endTime);
            $bookingDuration = $startDateTime->diff($endDateTime)->h;

            // Check if the student has already booked for the selected date
            $existingBookingQuery = "SELECT * FROM booking WHERE booking_date = ? AND student_ID = ?";
            $stmt = mysqli_prepare($con, $existingBookingQuery);
            mysqli_stmt_bind_param($stmt, 'si', $date, $studentID);
            mysqli_stmt_execute($stmt);
            $existingBookingResult = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($existingBookingResult) > 0) {
                $error = "You have already booked a parking spot for the selected date.";
            } elseif ($bookingDuration > 10) {
                $error = "You can only book a maximum of 10 hours per day.";
            } else {
                // No existing booking and duration is within limit, proceed with booking
                $qrCode = 'Generated QR Code'; // You need to generate the QR code
                $bookingQuery = "INSERT INTO booking (booking_startTime, booking_endTime, booking_date, booking_QRCode, parkingSlot_ID, student_ID) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($con, $bookingQuery);
                mysqli_stmt_bind_param($stmt, 'ssssii', $startTime, $endTime, $date, $qrCode, $parkingSlotID, $studentID);

                if (mysqli_stmt_execute($stmt)) {
                    header('Location: QRBooking.php');
                    exit;
                } else {
                    $error = "Error booking the parking spot: " . mysqli_error($con);
                }
            }
        }

        mysqli_close($con);
    ?>

    <main>
        <div class="booking-form-container">
            <h1>Edit Booking Form</h1>
            <p style="text-align: center;">Parking Spot: <?php echo $parkingSpot; ?></p>
            <?php if (isset($error)) { echo '<p style="color: red; text-align: center;">' . $error . '</p>'; } ?>
            <form id="bookingForm" action="" method="POST">
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
                <div class="form-buttons">
                    <button type="button" class="back-button" onclick="confirmBack()">Back</button>
                    <button type="button" class="confirm-button" onclick="confirmBooking()">Confirm Booking</button>
                </div>
            </form>
        </div>
    </main>

    <?php include '../Layout/allUserFooter.php'; ?>

    <script>
        function confirmBack() {
            if (confirm("Are you sure you want to go back?")) {
                window.history.back();
            }
        }

        function confirmBooking() {
            if (confirm("Are you sure you want to confirm this booking?")) {
                document.getElementById("bookingForm").submit();
            }
        }
    </script>
</body>
</html>

<?php
// End output buffering and flush output
ob_end_flush();
?>
