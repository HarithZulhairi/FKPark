<?php
session_start();
include '../Layout/studentHeader.php'; 

// Fetch user information from the database
$userID = $_SESSION['userID'];
$userDetails = getUserDetails($userID); // Fetch user details from DB

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission to update user details
    $email = $_POST['email'];
    $age = $_POST['age'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Handle profile image upload
    if (!empty($_FILES['profile_picture']['name'])) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);
        $profile_picture = $target_file;
    } else {
        $profile_picture = $userDetails['profile_picture'];
    }

    if (!empty($new_password) && $new_password == $confirm_password) {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    } else {
        $hashed_password = $userDetails['password'];
    }

    // Update user details in the database
    updateUserDetails($userID, $email, $age, $profile_picture, $hashed_password);
    // Refresh user details
    $userDetails = getUserDetails($userID);
}

function getUserDetails($userID) {
    // Connect to your database here
    $con = mysqli_connect("localhost", "root", "", "fkpark");

    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    $query = "SELECT * FROM Student WHERE student_ID = '$userID'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    } else {
        return null;
    }

    mysqli_close($con);
}

function updateUserDetails($userID, $email, $age, $profile_picture, $hashed_password) {
    // Connect to your database here
    $con = mysqli_connect("localhost", "root", "", "fkpark");

    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    $query = "UPDATE Student SET student_email = '$email', student_age = '$age', student_profile = '$profile_picture', student_password = '$hashed_password' WHERE student_ID = '$userID'";

    if (!mysqli_query($con, $query)) {
        echo "Error updating record: " . mysqli_error($con);
    }

    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="Profile.css">
    <script>
        function toggleEditMode() {
            var editBtn = document.getElementById('edit_profile_btn');
            var saveBtn = document.getElementById('save_profile_btn');
            var cancelBtn = document.getElementById('cancel_edit_btn');
            var inputs = document.querySelectorAll('.profile-details input:not([type="submit"])');
            var passwordFields = document.getElementById('password_fields');
            var profilePictureInput = document.getElementById('profile_picture_input');

            if (editBtn.style.display !== 'none') {
                editBtn.style.display = 'none';
                saveBtn.style.display = 'block';
                cancelBtn.style.display = 'block';
                inputs.forEach(input => input.removeAttribute('disabled'));
                passwordFields.style.display = 'block';
                profilePictureInput.style.display = 'block';
            } else {
                editBtn.style.display = 'block';
                saveBtn.style.display = 'none';
                cancelBtn.style.display = 'none';
                inputs.forEach(input => input.setAttribute('disabled', 'disabled'));
                passwordFields.style.display = 'none';
                profilePictureInput.style.display = 'none';
            }
        }

        function cancelEditMode() {
            var editBtn = document.getElementById('edit_profile_btn');
            var saveBtn = document.getElementById('save_profile_btn');
            var cancelBtn = document.getElementById('cancel_edit_btn');
            var inputs = document.querySelectorAll('.profile-details input:not([type="submit"])');
            var passwordFields = document.getElementById('password_fields');
            var profilePictureInput = document.getElementById('profile_picture_input');

            editBtn.style.display = 'block';
            saveBtn.style.display = 'none';
            cancelBtn.style.display = 'none';
            inputs.forEach(input => input.setAttribute('disabled', 'disabled'));
            passwordFields.style.display = 'none';
            profilePictureInput.style.display = 'none';
        }
    </script>
</head>

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f0f2f5;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        height: 100vh;

    }

    .profile-container {
        width: 100%;
        max-width: 1495px;
        background: #fff;
        padding: 43px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .profile-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .profile-header h2 {
        font-size: 24px;
        margin: 0;
    }

    .profile-header button {
        padding: 5px 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-size: 14px;
    }

    .profile-header button:hover {
        background-color: #0056b3;
    }

    .profile-content {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .profile-picture {
        margin-bottom: 20px;
    }

    .profile-picture img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #007bff;
    }

    .profile-details {
        width: 100%;
    }

    .profile-details form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .profile-details label {
        font-weight: bold;
        margin-top: 10px;
        align-self: flex-start;
    }

    .profile-details input {
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 100%;
        max-width: 500px;
        box-sizing: border-box;
    }

    .profile-details .input-group {
        display: flex;
        justify-content: space-between;
        width: 100%;
        max-width: 500px;
        margin-top: 10px;
    }

    .profile-details .input-group label {
        flex: 1;
        margin-right: 10px;
    }

    .profile-details .input-group input {
        flex: 2;
    }

    .profile-details button {
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .profile-details button:hover {
        background-color: #0056b3;
    }

    .profile-details button.save, .profile-details button.cancel {
        display: none;
    }

    #password_fields, #profile_picture_input {
        display: none;
    }
</style>

<body>
    <div class="profile-container">
        <div class="profile-header">
            <h2>Your Profile</h2>
            <div>
                <button type="button" id="edit_profile_btn" onclick="toggleEditMode()">Edit Profile</button>
                <button type="button" id="cancel_edit_btn" class="cancel" onclick="cancelEditMode()">Cancel</button>
            </div>
        </div>
        <div class="profile-content">
            <div class="profile-picture">
                <img src="<?php echo $userDetails['student_profile']; ?>" alt="Profile Picture">
            </div>
            <div class="profile-details">
                <form action="Profile.php" method="POST" enctype="multipart/form-data">
                    <div class="input-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" value="<?php echo $userDetails['student_username']; ?>" disabled>
                    </div>

                    <div class="input-group">
                        <label for="student_id">Student ID:</label>
                        <input type="text" id="student_id" value="<?php echo $userDetails['student_ID']; ?>" disabled>
                    </div>

                    <div class="input-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo $userDetails['student_email']; ?>" disabled>
                    </div>

                    <div class="input-group">
                        <label for="age">Age:</label>
                        <input type="number" id="age" name="age" value="<?php echo $userDetails['student_age']; ?>" disabled>
                    </div>

                    <div class="input-group">
                        <label for="type">Vehicle Type:</label>
                        <input type="text" id="v_type" name="vehicle_type" value="<?php echo $userDetails['vehicle_type']; ?>" disabled>
                    </div>

                    <div class="input-group">
                        <label for="numPlate">Number Plate:</label>
                        <input type="text" id="num_plate" name="number_plate" value="<?php echo $userDetails['number_plate']; ?>" disabled>
                    </div>

                    <div id="password_fields">
                        <div class="input-group">
                            <label for="new_password">New Password:</label>
                            <input type="password" id="new_password" name="new_password">
                        </div>

                        <div class="input-group">
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" id="confirm_password" name="confirm_password">
                        </div>
                    </div>

                    <div id="profile_picture_input">
                        <div class="input-group">
                            <label for="profile_picture">Profile Picture:</label>
                            <input type="file" id="profile_picture" name="profile_picture">
                        </div>
                    </div>

                    <button type="submit" id="save_profile_btn" class="save">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
    <?php include '../Layout/allUserFooter.php'; ?>
</body>
</html>

       
