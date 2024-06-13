<?php
session_start(); // Ensure the session is started
include '../DB_FKPark/dbcon.php';

$con = mysqli_connect("localhost", "root", "", "fkpark");



// Check if the user is logged in and the user ID is set in the session
$uk_ID = isset($_SESSION['userID']) ? $_SESSION['userID'] : null;

// If the student ID is not set, redirect to the login page
if ($uk_ID === null) {
    die('Unit Keselamatan Staff ID not found in session. Please login again.');
}


// Fetching all staff data

$query = "SELECT * FROM `unitkeselamatanstaff` WHERE uk_ID = $uk_ID";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

?>


// Fetching all administratort data

$query = "SELECT * FROM `unitkeselamatanstaff`";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Profile</title>
</head>
<style>
    .card-body{
        padding-bottom: 30px;
        
    }

    .container-layout {
        align-items: center;
        margin: auto;
     
    }
</style>
<body>
<?php include '../Layout/UKHeader.php'; ?>
<?php include '../DB_FKPark/dbcon.php'; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card rounded-0 mt-3 border-primary">
                <div class="card-header border-primary">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a href="#profile" class="nav-link font-weight-bold" data-bs-toggle="tab">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="#editProfile" class="nav-link font-weight-bold" data-bs-toggle="tab">Edit Profile</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane container active" id="profile">
                            <div class="card-deck">
                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <div class="card border-primary mb-3">
                                    <div class="card-header bg-primary text-light text-center lead">
                                        UnitKeselamatanStaff ID: <?= htmlspecialchars($row['uk_ID']); ?>
                                    </div>
                                    <div class="card-body">

                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Name: </b><?= htmlspecialchars($row['uk_username']); ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Password: </b><?= htmlspecialchars($row['uk_password']); ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Email: </b><?= htmlspecialchars($row['uk_email']); ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Age: </b><?= htmlspecialchars($row['uk_age']); ?></p>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="tab-pane container fade" id="editProfile">
                            <div class="card-deck">
                                <?php 
                                // Reset result pointer and fetch data again
                                mysqli_data_seek($result, 0);
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                <div class="card border-primary mb-3">
                                    <div class="card-header bg-primary text-light text-center lead">
                                    UnitKeselamatanStaff ID: <?= htmlspecialchars($row['uk_ID']); ?>
                                    </div>
                                    <div class="card-body">
                                    <form method="POST" action="update_profile.php" enctype="multipart/form-data">
                                        <input type="hidden" name="uk_ID" value="<?= htmlspecialchars($row['uk_ID']); ?>">
                                        
                                        <div class="mb-3">
                                            <label for="uk_username_<?= $row['uk_ID']; ?>" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="uk_username_<?= $row['uk_ID']; ?>" name="uk_username" value="<?= htmlspecialchars($row['uk_username']); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="uk_password_<?= $row['uk_ID']; ?>" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="uk_password_<?= $row['uk_ID']; ?>" name="uk_password" value="<?= htmlspecialchars($row['uk_password']); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="uk_email_<?= $row['uk_ID']; ?>" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="uk_email_<?= $row['uk_ID']; ?>" name="uk_email" value="<?= htmlspecialchars($row['uk_email']); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="uk_age_<?= $row['uk_ID']; ?>" class="form-label">Age</label>
                                            <input type="number" class="form-control" id="uk_age_<?= $row['uk_ID']; ?>" name="uk_age" value="<?= htmlspecialchars($row['uk_age']); ?>">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                        <button type="button" class="btn btn-secondary" onclick="window.location.reload();">Cancel</button>
                                    </form>

                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- Add content for EditProfile tab here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../Layout/allUserFooter.php'; ?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>

</body>
</html>

<?php mysqli_close($con); ?>

