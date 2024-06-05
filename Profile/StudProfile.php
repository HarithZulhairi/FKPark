<?php 
session_start();
$con = mysqli_connect("localhost", "root", "", "fkpark");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetching all student data
$query = "SELECT * FROM `student`";
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

    .container {
        align-items: center;
    }
</style>
<body>
<?php include '../Layout/studentHeader.php'; ?>
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
                                        Student ID: <?= htmlspecialchars($row['student_ID']); ?>
                                    </div>
                                    <div class="card-body">
                                        <p><img src="../ManageRegistration/uploads/<?= htmlspecialchars($row['student_profile']); ?>" alt="Profile Picture" width="100" height="100" class="rounded-circle mx-auto d-block"></p>

                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Name: </b><?= htmlspecialchars($row['student_username']); ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Password: </b><?= htmlspecialchars($row['student_password']); ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Email: </b><?= htmlspecialchars($row['student_email']); ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Age: </b><?= htmlspecialchars($row['student_age']); ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Phone Number: </b><?= htmlspecialchars($row['student_phoneNum']); ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Gender: </b><?= htmlspecialchars($row['student_gender']); ?></p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Birthdate: </b><?= htmlspecialchars($row['student_birthdate']); ?></p>
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
                                        Student ID: <?= htmlspecialchars($row['student_ID']); ?>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="update_profile.php" enctype="multipart/form-data">
                                            <input type="hidden" name="student_ID" value="<?= htmlspecialchars($row['student_ID']); ?>">
                                            <div class="mb-3">
                                                <label for="student_profile_<?= $row['student_ID']; ?>" class="form-label">Profile Picture</label>
                                                <input type="file" class="form-control" id="student_profile_<?= $row['student_ID']; ?>" name="student_profile">
                                                <input type="hidden" name="current_profile" value="<?= htmlspecialchars($row['student_profile']); ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="student_username_<?= $row['student_ID']; ?>" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="student_username_<?= $row['student_ID']; ?>" name="student_username" value="<?= htmlspecialchars($row['student_username']); ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="student_password_<?= $row['student_ID']; ?>" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="student_password_<?= $row['student_ID']; ?>" name="student_password" value="<?= htmlspecialchars($row['student_password']); ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="student_email_<?= $row['student_ID']; ?>" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="student_email_<?= $row['student_ID']; ?>" name="student_email" value="<?= htmlspecialchars($row['student_email']); ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="student_age_<?= $row['student_ID']; ?>" class="form-label">Age</label>
                                                <input type="number" class="form-control" id="student_age_<?= $row['student_ID']; ?>" name="student_age" value="<?= htmlspecialchars($row['student_age']); ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="student_phoneNum_<?= $row['student_ID']; ?>" class="form-label">Phone Number</label>
                                                <input type="text" class="form-control" id="student_phoneNum_<?= $row['student_ID']; ?>" name="student_phoneNum" value="<?= htmlspecialchars($row['student_phoneNum']); ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="student_gender_<?= $row['student_ID']; ?>" class="form-label">Gender</label>
                                                <input type="text" class="form-control" id="student_gender_<?= $row['student_ID']; ?>" name="student_gender" value="<?= htmlspecialchars($row['student_gender']); ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="student_birthdate_<?= $row['student_ID']; ?>" class="form-label">Birthdate</label>
                                                <input type="date" class="form-control" id="student_birthdate_<?= $row['student_ID']; ?>" name="student_birthdate" value="<?= htmlspecialchars($row['student_birthdate']); ?>">
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

