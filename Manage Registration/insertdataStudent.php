<?php

$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

mysqli_select_db($con, "fkpark") or die(mysqli_error($con));

$username = $_POST["Name"];
$password = $_POST["Password"];
$email = $_POST["Email"];
$age = $_POST["Age"];

$strSQL = "INSERT INTO student(student_username,student_password,student_email,student_age) VALUES('$username','$password','$email','$age')";

mysqli_query($con, $strSQL) or die(mysqli_error($con));


?>