<?php 
session_start();
$con = mysqli_connect("localhost", "root", "", "fkpark");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION['studentId'])) {
    $studentId = $_SESSION['studentId'];
    $query = "SELECT * FROM `Student` WHERE `student_ID` = $studentId";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($con));
    }

    $row = mysqli_fetch_assoc($result); // Fetching the data
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Profile</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .profile-container {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .profile-picture {
            text-align: center;
            margin-bottom: 20px;
        }
        .profile-picture img {
            max-width: 150px;
            border-radius: 50%;
            border: 3px solid #6c757d;
        }
        .profile-info {
            margin-bottom: 20px;
        }
        .profile-info h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .profile-info p {
            margin-bottom: 5px;
            color: #6c757d;
        }
        .profile-info .label {
            font-weight: bold;
            color: #495057;
        }
        .button-container {
            text-align: center;
        }
        .button-container button {
            width: 100px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <?php include '../Layout/studentHeader.php'; ?>
    <div class="container profile-container">
        <div class="profile-picture">
            <?php if (isset($row['student_profile'])): ?>
                <img src="upload/<?php echo htmlspecialchars($row['student_profile']); ?>" alt="Profile Picture">
            <?php else: ?>
                <p>Profile Picture Not Available</p>
            <?php endif; ?>
        </div>

        <div class="profile-info">
            <h2><?php echo $row['student_username']; ?></h2>
                <p><span class="label">Email:</span> <?php echo $row['student_email']; ?></p>
                <p><span class="label">Age:</span> <?php echo $row['student_age']; ?></p>
                <p><span class="label">Phone Number:</span> <?php echo $row['student_phoneNum']; ?></p>
                <p><span class="label">Gender:</span> <?php echo $row['student_gender']; ?></p>
                <p><span class="label">Birthdate:</span> <?php echo $row['student_birthdate']; ?></p>

        </div>

        <div class="button-container">
            <a href="../ManageRegistration/updateRegistration">
                <button type="button" class="btn btn-primary">Edit</button>
            </a>
        </div>
    </div>

    <?php
        if (isset($con)) {
            mysqli_close($con);
        }
    ?>
    <?php include '../Layout/allUserFooter.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
