<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $con = mysqli_connect("localhost", "root", "", "fkpark");

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $student_ID = $_POST['student_ID'];
    $student_username = $_POST['student_username'];
    $student_password = $_POST['student_password'];
    $student_email = $_POST['student_email'];
    $student_age = $_POST['student_age'];
    $student_phoneNum = $_POST['student_phoneNum'];
    $student_gender = $_POST['student_gender'];
    $student_birthdate = $_POST['student_birthdate'];

    if (isset($_FILES['student_profile']) && $_FILES['student_profile']['error'] === UPLOAD_ERR_OK) {
        $student_profile = $_FILES['student_profile']['name'];
        move_uploaded_file($_FILES['student_profile']['tmp_name'], "../ManageRegistration/uploads/$student_profile");
    } else {
        $student_profile = $_POST['current_profile'];
    }

    $query = "UPDATE `student` SET 
        `student_username`='$student_username', 
        `student_password`='$student_password', 
        `student_email`='$student_email', 
        `student_age`='$student_age', 
        `student_phoneNum`='$student_phoneNum', 
        `student_gender`='$student_gender', 
        `student_birthdate`='$student_birthdate', 
        `student_profile`='$student_profile' 
        WHERE `student_ID`='$student_ID'";

    if (mysqli_query($con, $query)) {
        header('Location: profile.php');
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
}
?>
