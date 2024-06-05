<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="ManageSummons.css" rel="stylesheet">
    <title>Manage Summons Page</title>
    <style>

        table.center {
            margin-left: auto; 
            margin-right: auto;
        }

        .logoUK {
            display: flex;
            justify-content: center; /* Horizontally centers the image */
            align-items: center; /* Vertically centers the image */
            margin-right: auto;
            margin-left: auto;
            width: 300px;
            height: 300px;
        }
        .logoUK img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 50%;
        }

        .box1 {
            display: flex;
            justify-content: space-between; /* Ensure elements are evenly distributed */
            align-items: center; /* Center items vertically */
            margin-bottom: 20px; /* Add space after the box1 div */
        }

        .box1 h2 {
            margin: 0; /* Reset default margin */
        }

        .box1 button{
            float: right;
        }

        .container-summonslist {
            width: 60%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        .button-container {
            margin-top: 5px;
                
        }

        .button-container button {
            margin: 0 10px;
            padding: 10px 10px;
            font-size: 16px;
            background-color:  #17252A;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }


        .button-container button[type="submit"]:hover {
            background-color: green;
        }

        .button-container button[type="view"] {
            background-color: #0000FF;
            width:70px;
            height:40px;
            margin-right:40px;
            font-weight: normal;
        }

        #list{
            margin-bottom:100px;

        }
        td{
            justify-content:center;
            text-align:center;
            
        }
        th{
            text-align:center;
        }
        
        h6{
            text-align:center;
            color:red;
        }

    </style>
</head>

<body>

    <?php include '../Layout/UKHeader.php'; ?>
    <?php include '../DB_FKPark/dbcon.php'; ?>

    <main>
    <div class="logoUK">
        <img src="../resource/logUK1.png" alt="Logo Unit Keselamatan UMPSA">
    </div>

    <div class="container-summonslist">
        <div class="box1">
            <h2>List of Summon</h2>
            <div class="button-container" >
            <button type="submit" class="button btn-primary "data-bs-toggle="modal" data-bs-target="#summonsModal">Create New Summon</button>
            </div>
        </div>

        <div id="list">
        <table class="table table-hover table-bordered table-striped" >
            <tr>
                <th style="width:280px;">Summon No</th>
                <th style="width:300px;">Vehicle No</th>
                <th style="width:180px;">Violation</th>
                <th style="width:180px;">Student ID</th>
                <th style="width:180px;">Action</th>
            </tr>

            <tbody>
            <?php
                        $query = "select * from `summon`";

                        $result = mysqli_query($con, $query);

                        if(!$result){
                            die("query Failed".mysqli_error());
                        }
                        else{
                            while($row = mysqli_fetch_assoc($result)){

                                ?>
                                    <tr>
                                        <td><?php echo$row['summon_ID']; ?></td>
                                        <td><?php echo$row['vehicle_numPlate']; ?></td>
                                        <td><?php echo$row['summon_violation']; ?></td>
                                        <td><?php echo$row['summon_datetime']; ?></td>

                                        <td style="border-collapse: collapse;display: flex; align-items: center;">
                                                <div style="margin:10px 10px;" class="button-container">
                                                    <a href="event-link-here" >
                                                        <button type="view">View</button>
                                                    </a>
                                                </div>

                                                <button type="submit" class="button btn btn-success" data-bs-toggle="modal" data-bs-target="#updateSummonsModal"
                                                onclick="populateUpdateModal('<?php echo $row['summon_ID']; ?>','<?php echo $row['vehicle_numPlate']; ?>','<?php echo $row['summon_violation']; ?>',
                                                '<?php echo $row['summon_datetime']; ?>','<?php echo $row['summon_location']; ?>')">Update</button>

                                                
                                                <a href="../ManageParkingArea/delete_page.php?id=<?php echo$row['summon_ID']; ?>" class="btn btn-danger">Delete</a>
                                                    
                                        </td>
                                    </tr>
                                <?php
                            }
                        }
                    ?>

            </tbody>

        </table>


        </div>

        <?php
                if(isset($_SESSION['message'])){
                    echo "<script>alert('" . $_SESSION['message'] . "');</script>";
                    unset($_SESSION['message']); // Clear the session message
                }
            ?>

        <?php
                if(isset($_GET['message'])){
                    echo "<h6>" .$_GET['message'] . "</h6>";
                }
            ?>

        <?php
                if(isset($_GET['update_msg'])){
                    echo "<h6>" .$_GET['update_msg'] . "</h6>";
                }
            ?>

        <?php
                if(isset($_GET['delete_msg'])){
                    echo "<h6>" .$_GET['delete_msg'] . "</h6>";
                }
            ?>

        <?php
        if (isset($_GET['insert_msg'])) {
            echo "<h6>" . $_GET['insert_msg'] . "</h6>";
            if (isset($_GET['qr_image'])) {
                echo "<h6>QR Code:</h6>";
                echo "<img src='../resource/" . $_GET['qr_image'] . "'>";
            }
        }
        ?>

    </div>
                


    
    </main>


    <?php include '../Layout/allUserFooter.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        function populateUpdateModal(id, vehicleNumPlate, violation, datetime, location) {
            document.getElementById('update_summon_id').value = id;
            document.getElementById('update_vehicleNumPlate').value = vehicleNumPlate;
            document.getElementById('update_violation').value = violation;
            document.getElementById('update_datetime').value = datetime;
            document.getElementById('update_location').value = location;

            document.getElementById('updateModalTitle').innerText = 'Update Summon ' + id;
        }
    </script>

 <!-- Modal Create Summons -->
 <form onsubmit="validateVehicleNumPlate()" action="insertSummons_data.php" method="POST"  >
 <div class="modal fade" id="summonsModal" tabindex="-1" role="dialog" aria-labelledby="summonsModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
  
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" >Create New Summon</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         
        </button>
      </div>
      <div class="modal-body">
        
            <div class="form-group">
                <label for="vehicleNumPlate">Vehicle Number Plate</label>
                <input type="text" id="vehicleNumPlate" name="vehicleNumPlate" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="violation">Violation</label>
                <select id="violation" name="violation" class="form-control" required>
                    <option value="" disabled selected>Select an option</option>
                    <option value="Speeding">Speeding</option>
                    <option value="Not Complying">Not Complying</option>
                    <option value="Accident">Accident</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" id="location" name="location" class="form-control" required>
            </div>


            <div class="form-group">
                <label for="datetime">Date and Time</label>
                <input type="datetime-local" id="datetime" name="datetime" class="form-control" required>
            </div>
                   
            
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-success" name="add_summons" value="CREATE">
      </div>
    </div>
  </div>
</div>
</form>

<!-- Modal Update Summons -->
<form action="updateSummons_data.php" method="POST" onsubmit="return validateVehicleNumPlate()">
    <div class="modal fade" id="updateSummonsModal" tabindex="-1" role="dialog" aria-labelledby="updateSummonsModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="update_summon_id" name="summon_id">

                    <div class="form-group">
                        <label for="update_vehicleNumPlate">Vehicle Number Plate</label>
                        <input type="text" id="update_vehicleNumPlate" name="vehicleNumPlate" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="update_violation">Violation</label>
                        <select id="update_violation" name="violation" class="form-control" required>
                            <option value="" disabled selected>Select an option</option>
                            <option value="Speeding">Speeding</option>
                            <option value="Not Complying">Not Complying</option>
                            <option value="Accident">Accident</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="update_location">Location</label>
                        <input type="text" id="update_location" name="location" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="update_datetime">Date and Time</label>
                        <input type="datetime-local" id="update_datetime" name="datetime" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-success" name="update_summons" value="UPDATE">
                </div>
            </div>
        </div>
    </div>
</form>

<script>
function validateVehicleNumPlate() {
    // Get the vehicle number plate entered by the user
    var vehicleNumPlate = document.getElementById("vehicleNumPlate").value;

    // Send an AJAX request to the server to check if the vehicle number plate exists
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "checkNumPlate.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // If the vehicle number plate exists, allow form submission
            if (xhr.responseText === "exists") {
                document.getElementById("summonsForm").submit();
            } else {
                // If the vehicle number plate does not exist, show a popup window
                alert("The vehicle number plate is not within the Vehicle table.");
                window.location.href = "ManageSummons.php";
            }
        }
    };
    // Send the request with the vehicle number plate data
    xhr.send("vehicleNumPlate=" + encodeURIComponent(vehicleNumPlate));

    // Prevent the form from submitting automatically
    return false;
}
</script>

</body>



</html>