<?php
session_start();

// Check if the user ID is set in the session
if (!isset($_SESSION['userID'])) {
    header("Location: ../Manage Login/login.html");
    exit;
}

$studentID = $_SESSION['userID'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="viewBooking.css">
    <title>Parking Booking Form</title>
</head>
<body>
    <?php include '../Layout/studentHeader.php'; ?>

    <main>
        <h2 class="title-view">List booking</h2>
        <div class="view-container">
            <table class="view-table">
                <tr class="view-table-header">
                    <th>No</th>
                    <th>Parking slot</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th colspan="3">Action</th>
                </tr>
                <?php
                // Connect to the database
                $con = mysqli_connect("localhost", "root", "", "fkpark");
                if (!$con) {
                    die('Could not connect: ' . mysqli_connect_error());
                }

                // Retrieve bookings for the logged-in user
                $query = "SELECT booking_ID, parkingSlot_name, booking_date, booking_startTime, booking_endTime 
                          FROM booking 
                          JOIN parkingSlot ON booking.parkingSlot_ID = parkingSlot.parkingSlot_ID 
                          WHERE student_ID = '$studentID'";
                $result = mysqli_query($con, $query);
                $counter = 1;

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr class='view-table-content'>
                                <td>{$counter}</td>
                                <td>{$row['parkingSlot_name']}</td>
                                <td>{$row['booking_date']}</td>
                                <td>{$row['booking_startTime']}</td>
                                <td>{$row['booking_endTime']}</td>
                                <td><a href='editBooking.php?bookingID={$row['booking_ID']}' class='action-btn'>Edit</a></td>
                                <td><a href='QRBooking.php?parkingSlotName={$row['parkingSlot_name']}&bookingDate={$row['booking_date']}&startTime={$row['booking_startTime']}&endTime={$row['booking_endTime']}' class='action-btn'>View QR</a></td>
                                <td><a href='#' onclick='confirmCancel({$row['booking_ID']})' class='action-btn'>Cancel</a></td>
                              </tr>";
                        $counter++;
                    }
                } else {
                    echo "Error retrieving bookings: " . mysqli_error($con);
                }

                mysqli_close($con);
                ?>
            </table>
        </div>
    </main>

    <?php include '../Layout/allUserFooter.php'; ?>

    <script>
        function confirmCancel(bookingID) {
            if (confirm("Are you sure you want to cancel this booking?")) {
                window.location.href = 'cancelBooking.php?bookingID=' + bookingID;
            }
        }
    </script>
</body>
</html>
