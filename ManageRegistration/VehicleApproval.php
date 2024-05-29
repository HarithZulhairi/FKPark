<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Registration</title>
    <style>
        /* Your CSS styles */

		#main_title {
			text-align: center;
		}

		.box1 h1 {
			float: left;
		}

		.box1 button {
			float: right;
			padding: 5px;
		}

		.view-container {
			margin-top: 50px;
		}

    </style>
</head>
<body>
    <?php include '../Layout/studentHeader.php'; ?>

    <div class="container2">
        <!-- Your HTML form -->
    </div>

    <?php include '../Layout/allUserFooter.php'; ?>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $con = mysqli_connect("localhost", "root", "", "fkpark");
        if (!$con) {
            die('Could not connect: ' . mysqli_connect_error());
        }

        mysqli_select_db($con, "fkpark") or die(mysqli_error($con));

        // Retrieve student ID from session
        $studentID = isset($_SESSION['student_ID']) ? $_SESSION['student_ID'] : null;

        if ($studentID === null) {
            die('Student ID not found in session. Please login again.');
        }

        // Retrieve other form data
        $vehicleType = $_POST["vehicleType"];
        $numPlate = $_POST["numPlate"];
        $brand = $_POST["brand"];
        $trans = $_POST["trans"];

        // Handle file upload
        $grantFile = $_FILES["grantFile"];
        $grantFileName = basename($grantFile["name"]);
        $targetDir = "uploads/";
        $targetFilePath = $targetDir . $grantFileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'pdf');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server
            if (move_uploaded_file($grantFile["tmp_name"], $targetFilePath)) {
                // Insert form data into the database
                $strSQL = "INSERT INTO vehicle(vehicle_numPlate, vehicle_type, vehicle_brand, vehicle_transmission, student_ID, vehicle_grant) VALUES('$numPlate','$vehicleType','$brand','$trans','$studentID','$targetFilePath')";

                if (mysqli_query($con, $strSQL)) {
                    echo "<script>alert('Vehicle registration successful!');</script>";
                } else {
                    echo "Error: " . mysqli_error($con);
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG, & PDF files are allowed.";
        }

        mysqli_close($con);
    }
    ?>
</body>
</html>
