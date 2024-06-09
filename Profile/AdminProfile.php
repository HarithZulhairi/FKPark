<?php 
session_start();
$con = mysqli_connect("localhost", "root", "", "fkpark");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetching data for the currently logged-in administrator
$userID = $_SESSION['userID']; // Assuming 'userID' is the session variable storing the user ID
$query = "SELECT * FROM `administrator` WHERE administrator_ID = $userID";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

// Fetching all administrator data (for privileged users)
if ($_SESSION['userID'] == 'administrator' || $_SESSION['userID'] == 'Unit Keselamatan Staff') {
    $queryAllAdmins = "SELECT * FROM `administrator`";
    $resultAllAdmins = mysqli_query($con, $queryAllAdmins);

    if (!$resultAllAdmins) {
        die("Query failed: " . mysqli_error($con));
    }
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

        .container {
            align-items: center;
        }
    </style>
<body>
<?php include '../Layout/adminHeader.php'; ?>
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
                                        Student ID: <?= htmlspecialchars($row['administrator_ID']); ?>
                                    </div>
                                    <div class="card-body">

                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Name: </b><?= htmlspecialchars($row['administrator_username']); ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Password: </b><?= htmlspecialchars($row['administrator_password']); ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Email: </b><?= htmlspecialchars($row['administrator_email']); ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Age: </b><?= htmlspecialchars($row['administrator_age']); ?></p>
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
                                        Administrator ID: <?= htmlspecialchars($row['administrator_ID']); ?>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action ="update_profile.php" enctype="multipart/form-data">
                                                <input type="hidden" name="administrator_ID" value="<?= htmlspecialchars($row['administrator_ID']); ?>">
                                                <div class="mb-3">
                                                    <label for="administrator_username_<?= $row['administrator_ID']; ?>" class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="administrator_username_<?= $row['administrator_ID']; ?>" name="administrator_username" value="<?= htmlspecialchars($row['administrator_username']); ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="administrator_password_<?= $row['administrator_ID']; ?>" class="form-label">Password</label>
                                                    <input type="password" class="form-control" id="administrator_password_<?= $row['administrator_ID']; ?>" name="administrator_password" value="<?= htmlspecialchars($row['administrator_password']); ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="administrator_email_<?= $row['administrator_ID']; ?>" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="administrator_email_<?= $row['administrator_ID']; ?>" name="administrator_email" value="<?= htmlspecialchars($row['administrator_email']); ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="administrator_age_<?= $row['administrator_ID']; ?>" class="form-label">Age</label>
                                                    <input type="number" class="form-control" id="administrator_age_<?= $row['administrator_ID']; ?>" name="administrator_age" value="<?= htmlspecialchars($row['administrator_age']); ?>">
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
