<?php
// Include the necessary files
ob_start();
include '../Layout/UKHeader.php'; 
include '../DB_FKPark/dbcon.php';

// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the "Approve" button was clicked
    if (isset($_POST['approve_vehicle_numPlate'])) {
        $vehicle_numPlate_to_approve = $_POST['approve_vehicle_numPlate'];
        $student_ID = $_POST['student_ID'];
        
        // Update the approval status to 'Successful' and delete the row
        $approveQuery = "INSERT INTO approval (vehicle_grant, approval_status, student_ID)
                         VALUES ('$vehicle_numPlate_to_approve', 'Successful', '$student_ID')
                         ON DUPLICATE KEY UPDATE approval_status='Successful'";
        $approveResult = mysqli_query($con, $approveQuery);

        if (!$approveResult) {
            die("Approval failed: " . mysqli_error($con));
        } else {
            // Redirect back to VehicleApproval.php with a success message
            header('Location: ../ManageRegistration/VehicleApproval.php?message=Vehicle has been approved successfully');
            exit;
        }
    } elseif (isset($_POST['cancel_vehicle_numPlate'])) {
        // Check if the "Decline" button was clicked
        $vehicle_numPlate_to_cancel = $_POST['cancel_vehicle_numPlate'];
        $student_ID = $_POST['student_ID'];
        
        // Update the approval status to 'Unsuccessful' and delete the row
        $cancelQuery = "INSERT INTO approval (vehicle_grant, approval_status, student_ID)
                        VALUES ('$vehicle_numPlate_to_cancel', 'Unsuccessful', '$student_ID')
                        ON DUPLICATE KEY UPDATE approval_status='Unsuccessful'";
        $cancelResult = mysqli_query($con, $cancelQuery);

        if (!$cancelResult) {
            die("Cancellation failed: " . mysqli_error($con));
        } else {
            // Redirect back to VehicleApproval.php with a success message
            header('Location: ../ManageRegistration/VehicleApproval.php?message=Vehicle registration has been declined');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags and CSS links -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="viewRegistration.css">
    <title>List of Vehicles</title>
    <!-- Your custom styles -->
</head>
<body>
    <main>
        <h1 id="main_title">List Of Vehicles</h1>
        <div class="view-container">
            <table class="table table-hover table-bordered table-striped">
                <thead>
                    <tr class="view-table-header">
                        <th>Number Plate</th>
                        <th>Type</th>
                        <th>Brand</th>
                        <th>Transmission</th>
                        <th>Grant</th>
                        <th>Student ID</th>
                        <th>Approve</th>
                        <th>Decline</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Retrieve vehicle data from the database
                    $query = "SELECT * FROM Vehicle";
                    $result = mysqli_query($con, $query);

                    if (!$result) {
                        die("Query failed: " . mysqli_error($con));
                    } else {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row['vehicle_numPlate']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['vehicle_type']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['vehicle_brand']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['vehicle_transmission']) . '</td>';
                            echo '<td><img src="' . htmlspecialchars($row['vehicle_grant']) . '" alt="Vehicle Grant" width="100"></td>';
                            echo '<td>' . htmlspecialchars($row['student_ID']) . '</td>';
                            echo '<td><button type="button" class="btn btn-success approve-button" data-id="' . htmlspecialchars($row['vehicle_numPlate']) . '" data-student="' . htmlspecialchars($row['student_ID']) . '">Approve</button></td>';
                            echo '<td><button type="button" class="btn btn-danger cancel-button" data-id="' . htmlspecialchars($row['vehicle_numPlate']) . '" data-student="' . htmlspecialchars($row['student_ID']) . '">Decline</button></td>';
                            echo '</tr>';
                        }
                    }
                    mysqli_close($con);
                   ?>
                </tbody>
            </table>
        </div>
    </main>
    <?php include '../Layout/allUserFooter.php'; ?>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var approveButtons = document.querySelectorAll('.approve-button');
        approveButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var vehicleNumPlate = this.getAttribute('data-id');
                var studentID = this.getAttribute('data-student');
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = 'VehicleApproval.php';
                var input1 = document.createElement('input');
                input1.type = 'hidden';
                input1.name = 'approve_vehicle_numPlate';
                input1.value = vehicleNumPlate;
                form.appendChild(input1);
                var input2 = document.createElement('input');
                input2.type = 'hidden';
                input2.name = 'student_ID';
                input2.value = studentID;
                form.appendChild(input2);
                document.body.appendChild(form);
                form.submit();
                
                // Remove the button and add "DONE" text
                var doneText = document.createElement('span');
                doneText.textContent = 'DONE';
                doneText.style.color = 'green';
                button.parentNode.replaceChild(doneText, button);
                
                // Delete the row from the table
                deleteRow(vehicleNumPlate);
            });
        });

        var cancelButtons = document.querySelectorAll('.cancel-button');
        cancelButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var vehicleNumPlate = this.getAttribute('data-id');
                var studentID = this.getAttribute('data-student');
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = 'VehicleApproval.php';
                var input1 = document.createElement('input');
                input1.type = 'hidden';
                input1.name = 'cancel_vehicle_numPlate';
                input1.value = vehicleNumPlate;
                form.appendChild(input1);
                var input2 = document.createElement('input');
                input2.type = 'hidden';
                input2.name = 'student_ID';
                input2.value = studentID;
                form.appendChild(input2);
                document.body.appendChild(form);
                form.submit();
                
                // Remove the button and add "DONE" text
                var doneText = document.createElement('span');
                doneText.textContent = 'DONE';
                doneText.style.color = 'green';
                button.parentNode.replaceChild(doneText, button);
                
                // Delete the row from the table
                deleteRow(vehicleNumPlate);
            });
        });
        
        function deleteRow(vehicleNumPlate) {
            // Send an AJAX request to delete the row from the database
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'deleteRow.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log('Row deleted successfully');
                } else {
                    console.log('Error deleting row');
                }
            };
            xhr.send('vehicleNumPlate=' + encodeURIComponent(vehicleNumPlate));
        }
    });
</script>



</body>
</html>
