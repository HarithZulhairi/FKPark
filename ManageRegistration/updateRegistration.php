<?php include '../Layout/adminHeader.php'; ?>
<?php include '../DB_FKPark/dbcon.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<?php
if (isset($_GET['student_ID'])) {
    $student_ID = $_GET['student_ID'];

    $query = "SELECT * FROM student WHERE student_ID = '$student_ID'";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($con));
    } else {
        $row = mysqli_fetch_assoc($result);
    }
}
?>

<?php
if (isset($_POST['updateRegister'])) {
    $student_username = $_POST['student_username'];
    $student_password = $_POST['student_password'];
    $student_email = $_POST['student_email'];
    $student_age = $_POST['student_age'];
    $student_phoneNum = $_POST['student_phoneNum'];
    $student_gender = $_POST['student_gender'];
    $student_birthdate = $_POST['student_birthdate'];
    $student_profile = $_POST['student_profile'];

    $updateQuery = "UPDATE student SET 
                    student_username = '$student_username', 
                    student_password = '$student_password', 
                    student_email = '$student_email', 
                    student_age = '$student_age', 
                    student_phoneNum = '$student_phoneNum', 
                    student_gender = '$student_gender', 
                    student_birthdate = '$student_birthdate', 
                    student_profile = '$student_profile' 
                    WHERE student_ID = '$student_ID'";

    $updateResult = mysqli_query($con, $updateQuery);

    if (!$updateResult) {
        die("Query failed: " . mysqli_error($con));
    } else {
        header('Location: viewRegistration.php?update_msg=You have successfully updated the data');
        exit;
    }
}
?>

<form method="post" action="updateRegistration.php?student_ID=<?php echo $student_ID; ?>">
    <div class="form-group">
        <label for="student_username">Username</label>
        <input type="text" name="student_username" class="form-control" value="<?php echo $row['student_username']; ?>">
    </div>
    <div class="form-group">
        <label for="student_password">Password</label>
        <input type="password" name="student_password" class="form-control" value="<?php echo $row['student_password']; ?>">
    </div>
    <div class="form-group">
        <label for="student_email">Email</label>
        <input type="email" name="student_email" class="form-control" value="<?php echo $row['student_email']; ?>">
    </div>
    <div class="form-group">
        <label for="student_age">Age</label>
        <input type="text" name="student_age" class="form-control" value="<?php echo $row['student_age']; ?>">
    </div>
    <div class="form-group">
        <label for="student_phoneNum">Phone Number</label>
        <input type="text" name="student_phoneNum" class="form-control" value="<?php echo $row['student_phoneNum']; ?>">
    </div>
    <div class="form-group">
        <label for="student_gender">Gender</label>
        <input type="checkbox" name="student_gender" class="form-control" value="<?php echo $row['student_gender']; ?>">
    </div>
    <div class="form-group">
        <label for="student_birthdate">Birthday</label>
        <input type="date" name="student_birthdate" class="form-control" value="<?php echo $row['student_birthdate']; ?>">
    </div>
    <div class="form-group">
        <label for="student_profile">Student Profile</label>
        <input type="text" name="student_profile" class="form-control" value="<?php echo $row['student_profile']; ?>">
    </div>

    <input type="submit" class="btn btn-success" name="updateRegister" value="UPDATE">
</form>

<?php include '../Layout/allUserFooter.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
