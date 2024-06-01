<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="viewRegistration.css">
    <title>List of Vehicles</title>
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
        }
        footer .container {
            display: flex;
            justify-content: space-between;
        }
        footer .container div {
            flex: 1;
            padding: 0 50px;
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
    </style>
</head>
<body>
    <?php include '../Layout/adminHeader.php'; ?>
    <?php include '../DB_FKPark/dbcon.php'; ?>

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
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query = "SELECT * FROM `Vehicle`";
                        $result = mysqli_query($con, $query);

                        if(!$result){
                            die("Query failed: " . mysqli_error($con));
                        } else {
                            while($row = mysqli_fetch_assoc($result)){
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['vehicle_numPlate']); ?></td>
                            <td><?php echo htmlspecialchars($row['vehicle_type']); ?></td>
                            <td><?php echo htmlspecialchars($row['vehicle_brand']); ?></td>
                            <td><?php echo htmlspecialchars($row['vehicle_transmission']); ?></td>
                            <td><img src="<?php echo htmlspecialchars($row['vehicle_grant']); ?>" alt="Vehicle Grant" width="100"></td>
                            <td><?php echo htmlspecialchars($row['student_ID']); ?></td>
                            <td><button type="button" class="btn btn-success approve-button" data-id="<?php echo htmlspecialchars($row['vehicle_numPlate']); ?>">Approve</button></td>
                        </tr>
                    <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <?php
            if (isset($_GET['message'])) {
                echo "<h6>" . htmlspecialchars($_GET['message']) . "</h6>";
            }
        ?>

        <?php
            if (isset($_GET['insert_msg'])) {
                echo "<h6>" . htmlspecialchars($_GET['insert_msg']) . "</h6>";
            }
        ?>

        <?php
        // Handle approval of vehicle
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['approve_vehicle_numPlate'])) {
            // Retrieve vehicle number plate from the POST data
            $vehicle_numPlate_to_approve = $_POST['approve_vehicle_numPlate'];

            // Construct the SQL update query to approve the vehicle (example: setting a status column to 'approved')
            $approveQuery = "UPDATE Vehicle SET status = 'approved' WHERE vehicle_numPlate = '$vehicle_numPlate_to_approve'";

            // Execute the approve query
            $approveResult = mysqli_query($con, $approveQuery);

            // Check if the query was successful
            if (!$approveResult) {
                // If query fails, display error message
                die("Approval failed: " . mysqli_error($con));
            } else {
                // If query succeeds, redirect to viewRegistration.php with success message
                header('Location:../ManageRegistration/viewRegistration.php?approve_msg=Vehicle has been approved successfully');
                exit;
            }
        }
        mysqli_close($con);
        ?>
    </main>

    <footer>
        <div class="container">
            <div>
                <h5>About FKPark</h5>
                <p>FKPark is a premier parking management system providing seamless and efficient parking solutions.</p>
            </div>
            <div>
                <h5>Quick Links</h5>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Booking</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div>
                <h5>Contact Us</h5>
                <p>Email: info@fkpark.com<br>Phone: +123 456 7890</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var approveButtons = document.querySelectorAll('.approve-button');
            approveButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var vehicleNumPlate = this.getAttribute('data-id');
                    
                    // Create a form and submit it
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = 'viewRegistration.php';

                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'approve_vehicle_numPlate';
                    input.value = vehicleNumPlate;

                    form.appendChild(input);
                    document.body.appendChild(form);
                    form.submit();
                });
            });
        });
    </script>
</body>
</html>
