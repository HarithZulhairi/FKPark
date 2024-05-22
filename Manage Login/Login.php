<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userType = $_POST['userType'];

    // Connect to the database
    $con = new mysqli("localhost", "root", "", "fkpark");

    if ($con->connect_error) {
        echo json_encode(["success" => false, "message" => "Connection failed: " . $con->connect_error]);
        exit();
    }

    // Escape the input data
    $username = $con->real_escape_string($username);
    $password = $con->real_escape_string($password);
    $userType = $con->real_escape_string($userType);

    // Adjust the query based on user type
    if ($userType == 'student') {
        $sql = "SELECT * FROM Student WHERE student_username='$username' AND student_password='$password'";
        $userIDColumn = "student_ID"; // Adjust the column name accordingly
    } else if ($userType == 'administrator') {
        $sql = "SELECT * FROM Administrator WHERE administrator_username='$username' AND administrator_password='$password'";
        $userIDColumn = "administrator_ID"; // Adjust the column name accordingly
    } else if ($userType == 'unit_staff') {
        $sql = "SELECT * FROM UnitKeselamatanStaff WHERE uk_username='$username' AND uk_password='$password'";
        $userIDColumn = "uk_ID"; // Adjust the column name accordingly
    }

    $result = $con->query($sql);

    if ($result === false) {
        echo json_encode(["success" => false, "message" => "Error: " . $con->error]);
    } else if ($result->num_rows == 1) {
        // Successful login
        $row = $result->fetch_assoc();
        $_SESSION['userID'] = $row[$userIDColumn]; // Store userID in session

        // Determine redirect URL based on user type
        $redirectURL = '';
        if ($userType == 'student') {
            $redirectURL = "../Home/homeStudent.php";
        } else if ($userType == 'administrator') {
            $redirectURL = "../Home/homeAdmin.php";
        } else if ($userType == 'unit_staff') {
            $redirectURL = "../Home/homeUK.php";
        }

        echo json_encode(["success" => true, "redirectURL" => $redirectURL]);
    } else {
        // Failed login
        echo json_encode(["success" => false, "message" => "Incorrect username or password. Please try again."]);
    }

    $con->close();
}
?>
