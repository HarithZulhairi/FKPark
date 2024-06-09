<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$con = new mysqli("localhost", "root", "", "fkpark");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Handle deletion
if (isset($_GET['delete_student_id'])) {
    $studentId = $_GET['delete_student_id'];

    // Delete the student record
    $query = "DELETE FROM Student WHERE student_ID = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $studentId);

    if ($stmt->execute()) {
        header("Location: viewRegistration.php?message=Record deleted successfully");
        exit;
    } else {
        echo "Error deleting record: " . $con->error;
    }
    $stmt->close();
}

// Handle form submission for updating student info
if (isset($_POST['save_changes'])) {
    $id = $_POST['student_ID'];
    $username = $_POST['student_username'];
    $password = $_POST['student_password'];
    $email = $_POST['student_email'];
    $age = $_POST['student_age'];
    $phoneNum = $_POST['student_phoneNum'];
    $gender = $_POST['student_gender'];
    $birthdate = $_POST['student_birthdate'];
    $profile = $_POST['student_profile'];

    $query = "UPDATE Student SET student_username=?, student_password=?, student_email=?, student_age=?, student_phoneNum=?, student_gender=?, student_birthdate=?, student_profile=? WHERE student_ID=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("sssissssi", $username, $password, $email, $age, $phoneNum, $gender, $birthdate, $profile, $id);

    if ($stmt->execute()) {
        header("Location: viewRegistration.php?message=Record updated successfully");
        exit;
    } else {
        echo "Error updating record: " . $con->error;
    }
    $stmt->close();
}

$query = "SELECT * FROM Student";
$result = $con->query($query);

if (!$result) {
    die("Query failed: " . $con->error);
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>List of Registration</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1;
        }
        footer {
            background: #333;
            color: #fff;
            padding: 20px 0;
            margin-top: auto;
        }
        footer .container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        footer .container div {
            flex: 1;
            padding: 0 20px;
            text-align: center;
        }
        footer h5 {
            margin-top: 0;
        }
        footer ul {
            list-style: none;
            padding: 0;
        }
        footer ul li {
            margin: 5px 0;
        }
        footer ul li a {
            color: #fff;
            text-decoration: none;
        }
        footer ul li a:hover {
            text-decoration: underline;
        }
        .view-container {
            text-align: center;
        }
    </style>
</head>
<body>
    <?php include '../Layout/adminHeader.php'; ?>

    <main>
        <h1 id="main_title">List Of Registration</h1>

        <div class="view-container">
            <div class="d-flex justify-content-end mb-3">
                <a href="StudentRegistration.php" class="btn btn-primary">REGISTER</a>
            </div>

            <table class="table table-hover table-bordered table-striped">
                <thead>
                    <tr class="view-table-header">
                        <th>Student ID</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Email</th>
                        <th>Age</th>
                        <th>Phone Number</th>
                        <th>Gender</th>
                        <th>Birthdate</th>
                        <th>Profile Picture</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['student_ID']); ?></td>
                        <td><?php echo htmlspecialchars($row['student_username']); ?></td>
                        <td><?php echo htmlspecialchars($row['student_password']); ?></td>
                        <td><?php echo htmlspecialchars($row['student_email']); ?></td>
                        <td><?php echo htmlspecialchars($row['student_age']); ?></td>
                        <td><?php echo htmlspecialchars($row['student_phoneNum']); ?></td>
                        <td><?php echo htmlspecialchars($row['student_gender']); ?></td>
                        <td><?php echo htmlspecialchars($row['student_birthdate']); ?></td>
                        <td><img src="../ManageRegistration/uploads/<?= htmlspecialchars($row['student_profile']); ?>" alt="Profile Picture" width="100" height="100" class="rounded-circle mx-auto d-block"></td>
                        <td><button type="button" class="btn btn-success update-button" data-id="<?php echo htmlspecialchars($row['student_ID']); ?>" data-bs-toggle="modal" data-bs-target="#updateModal">Update</button></td>
                        <td><a href="viewRegistration.php?delete_student_id=<?php echo htmlspecialchars($row['student_ID']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <?php
        if (isset($_GET['message'])) {
            echo "<h6>" . htmlspecialchars($_GET['message']) . "</h6>";
        }

        if (isset($_GET['insert_msg'])) {
            echo "<h6>" . htmlspecialchars($_GET['insert_msg']) . "</h6>";
        }
        ?>

        <!-- Modal -->
        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Student Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateForm" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="updateStudentId" name="student_ID">
                            <div class="mb-3">
                                <label for="updateUsername" class="form-label">Username</label>
                                <input type="text" class="form-control" placeholder="Enter username" id="updateUsername" name="student_username" required>
                            </div>
                            <div class="mb-3">
                                <label for="updatePassword" class="form-label">Password</label>
                                <input type="text" class="form-control" placeholder="Enter password" id="updatePassword" name="student_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="updateEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="Enter email" id="updateEmail" name="student_email" required>
                            </div>
                            <div class="mb-3">
                                <label for="updateAge" class="form-label">Age</label>
                                <input type="number" class="form-control" placeholder="Enter age" id="updateAge" name="student_age" required>
                            </div>
                            <div class="mb-3">
                                <label for="updatePhoneNumber" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" placeholder="Enter phone number" id="updatePhoneNumber" name="student_phoneNum" required>
                            </div>
                            <div class="mb-3">
                                <label for="updateGender" class="form-label">Gender</label>
                                <input type="text" class="form-control" placeholder="Enter gender" id="updateGender" name="student_gender" required>
                            </div>
                            <div class="mb-3">
                                <label for="updateBirthday" class="form-label">Birthdate</label>
                                <input type="date" class="form-control" placeholder="Enter Birthdate" id="updateBirthday" name="student_birthdate" required>
                            </div>
                            <div class="mb-3">
                                <label for="updateProfilePicture" class="form-label">Profile Picture</label>
                                <input type="file" class="form-control" accept="image/*" id="updateProfilePicture" name="student_profile">
                            </div>
                            <button type="submit" class="btn btn-primary" name="save_changes" value="submit">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </main>

    <?php include '../Layout/allUserFooter.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
       document.addEventListener('DOMContentLoaded', function () {
    var updateButtons = document.querySelectorAll('.update-button');
    updateButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var studentId = this.getAttribute('data-id');

            // Fetch the student data using studentId
            fetch(`getStudentData.php?id=${studentId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('updateStudentId').value = data.student_ID;
                    document.getElementById('updateUsername').value = data.student_username;
                    document.getElementById('updatePassword').value = data.student_password;
                    document.getElementById('updateEmail').value = data.student_email;
                    document.getElementById('updateAge').value = data.student_age;
                    document.getElementById('updatePhoneNumber').value = data.student_phoneNum;
                    document.getElementById('updateGender').value = data.student_gender;
                    document.getElementById('updateBirthday').value = data.student_birthdate;
                });
        });
    });

    document.getElementById('updateForm').addEventListener('submit', function(event) {
        event.preventDefault();

        // Implement the form submission to update student data
        var formData = new FormData(this);
        fetch('viewRegistration.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert('Student updated successfully!');
            location.reload();
        })
        .catch(error => {
            alert('Failed to update student.');
            console.error('Error:', error);
        });
    });
});

    </script>
</body>
</html>
