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
    } else {
        // Assuming other user types are stored in a different table named 'users'
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' AND user_type='$userType'";
    }

    $result = $con->query($sql);

    if ($result === false) {
        echo json_encode(["success" => false, "message" => "Error: " . $con->error]);
    } else if ($result->num_rows == 1) {
        // Successful login
        $row = $result->fetch_assoc();
        $userID = $row['student_ID']; // Assign student_ID to $userID
        $_SESSION['userID'] = $userID; // Store userID in session
        echo json_encode(["success" => true]);
    } else {
        // Failed login
        echo json_encode(["success" => false, "message" => "Incorrect username or password. Please try again."]);
    }

    $con->close();
}
?>
