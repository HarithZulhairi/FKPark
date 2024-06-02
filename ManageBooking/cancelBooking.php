<?php
    session_start();

    if (!isset($_SESSION['userID'])) {
        header("Location: ../Manage Login/login.html");
        exit;
    }

    $studentID = $_SESSION['userID'];

    // Check if booking ID is passed
    if (!isset($_GET['bookingID'])) {
        echo "No booking ID provided.";
        exit;
    }

    $bookingID = $_GET['bookingID'];

    // Connect to the database
    $con = mysqli_connect("localhost", "root", "", "fkpark");
    if (!$con) {
        die('Could not connect: ' . mysqli_connect_error());
    }

    // Check if the booking belongs to the student
    $query = "DELETE FROM booking WHERE booking_ID = ? AND student_ID = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $bookingID, $studentID);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: viewBooking.php');
        exit;
    } else {
        echo "Error cancelling the booking: " . mysqli_error($con);
    }

    mysqli_close($con);
?>
