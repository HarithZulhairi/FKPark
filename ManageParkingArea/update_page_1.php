<?php
ob_start(); // Start output buffering

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Parking Booking Form</title>
    <style>
        table.center {
            margin-left: auto; 
            margin-right: auto;
            width: 900px;
            margin-top: 70px;
        }
    </style>
</head>
<body>
<?php include '../Layout/adminHeader.php'; ?>
<?php include '../DB_FKPark/dbcon.php'; // Include the database connection file. ?>



<h2 style="text-align:center">Update Parking</h2>

<form action="" method="POST">
    <table class="center">
        <tbody>
            <?php
            $row = [];
            $p_area = ""; // Define $p_area with a default value

            if(isset($_GET['id'])){
                $p_area = $_GET['id'];
                $query = "SELECT * FROM `parkingArea` WHERE `parkingArea_ID` = '$p_area'"; // Fixed variable name typo '$id' to '$p_area'

                $result = mysqli_query($con, $query);

                if(!$result){
                    die("query Failed" . mysqli_error($con));
                } else {
                    $row = mysqli_fetch_assoc($result);

                    if($row !== null) {
                        // Your existing code to print and use $row
                        ?>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="p_area">Parking Area</label>
                                    <select name="p_area" class="form-control">
                                        <option value="B1" <?php echo ($row['parkingArea_name'] == 'B1') ? 'selected' : ''; ?>>B1</option>
                                        <option value="B2" <?php echo ($row['parkingArea_name'] == 'B2') ? 'selected' : ''; ?>>B2</option>
                                        <option value="B3" <?php echo ($row['parkingArea_name'] == 'B3') ? 'selected' : ''; ?>>B3</option>
                                        <option value="M1" <?php echo ($row['parkingArea_name'] == 'M1') ? 'selected' : ''; ?>>M1</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="p_status">Parking Status</label>
                                    <select name="p_status" class="form-control">
                                        <option value="AVAILABLE" <?php echo ($row['parkingArea_status'] == 'AVAILABLE') ? 'selected' : ''; ?>>AVAILABLE</option>
                                        <option value="UNAVAILABLE" <?php echo ($row['parkingArea_status'] == 'UNAVAILABLE') ? 'selected' : ''; ?>>UNAVAILABLE</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input style="margin-top:20px;" type="submit" class="btn btn-success" name="update_parking" value="UPDATE"></td>
                        </tr>
                        <?php
                    } else {
                        // Handle the case where $row is null
                        echo "No data found for the given parking area.";
                    }
                }
            }

            // Check if the form is submitted
            if(isset($_POST['update_parking'])){
                $update_p_area = $_POST['p_area'];
                $update_p_status = $_POST['p_status'];

                // Perform the database update
                $query = "UPDATE `parkingArea` SET `parkingArea_name` = '$update_p_area', 
                                                `parkingArea_status` = '$update_p_status' 
                          WHERE `parkingArea_ID` = '$p_area'"; // Changed `$id_new` to `$p_area`

                $result = mysqli_query($con, $query);

                if(!$result){
                    die("query Failed" . mysqli_error($con));
                } else {
                    // Redirect to the ManageParking.php file
                    header('location:../ManageParkingArea/ManageParking.php?update_msg=You have successfully updated the data!');
                    exit; // Exit to prevent further execution
                }
            }
            ?>
        </tbody>
    </table>
</form>

<?php include '../Layout/allUserFooter.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php
ob_end_flush(); // Flush the output buffer and send the output to the browser
?>
