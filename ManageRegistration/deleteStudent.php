<?php
include '../DB_FKPark/dbcon.php';

if (isset($_GET['id'])) {
    $student_ID = $_GET['id'];
    $query = "DELETE FROM student WHERE student_ID = '$student_ID'";

    if (mysqli_query($con, $query)) {
        header('Location: viewRegistration.php?message=Student deleted successfully');
    } else {
        header('Location: viewRegistration.php?message=Error deleting student: ' . mysqli_error($con));
    }
}
?>
