<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userType = $_POST['userType'];

    $con = new mysqli("localhost", "root", "", "fkpark");

    if ($con->connect_error) {
        echo json_encode(["success" => false, "message" => "Connection failed: " . $con->connect_error]);
        exit();
    }

    // Escape the input data
    $username = $con->real_escape_string($username);
    $password = $con->real_escape_string($password);
    $userType = $con->real_escape_string($userType);

    if ($userType == 'student') {
        $sql = "SELECT * FROM Student WHERE student_username='$username' AND student_password='$password'";
        $userIDColumn = "student_ID";
        $userProfileColumn = "student_profile"; // Profile column for the student
        $usernameColumn = "student_username"; // Username column for the student
    } else if ($userType == 'administrator') {
        $sql = "SELECT * FROM Administrator WHERE administrator_username='$username' AND administrator_password='$password'";
        $userIDColumn = "administrator_ID";
        $usernameColumn = "administrator_username"; // Username column for the administrator
    } else if ($userType == 'Unit Keselamatan Staff') {
        $sql = "SELECT * FROM UnitKeselamatanStaff WHERE uk_username='$username' AND uk_password='$password'";
        $userIDColumn = "uk_ID";
        $usernameColumn = "uk_username"; // Username column for the unit staff
    }

    $result = $con->query($sql);

    if ($result->num_rows == 1) {
        // Successful login
        $row = $result->fetch_assoc();
        $_SESSION['userID'] = $row[$userIDColumn]; // Store userID in session

        // Fetch the username
        $loggedInUsername = $row[$usernameColumn];

        // Store username in session
        $_SESSION['username'] = $loggedInUsername;

        // Determine redirect URL based on user type
        $redirectURL = '';
        if ($userType == 'student') {
            $redirectURL = "../Home/studentHomePage.php";
        } else if ($userType == 'administrator') {
            $redirectURL = "../Home/adminHomePage.php";
        } else if ($userType == 'unit_staff') {
            $redirectURL = "../Home/ukHomePage.php";
        }

        echo json_encode(["success" => true, "redirectURL" => $redirectURL]);
    } else {
        // Failed login
        echo json_encode(["success" => false, "message" => "Incorrect username or password. Please try again."]);
    }

    $con->close();
}
?>
