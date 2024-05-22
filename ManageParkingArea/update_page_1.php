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
          width:900px;
          margin-top:70px;
        }

    </style>
</head>
<body>
<?php include '../Layout/adminHeader.php'; ?>
<?php include '../DB_FKPark/dbcon.php'; ?>

<?php
$row = [];
$p_area = ""; // Define $p_area with a default value

if(isset($_GET['p_area'])){
    $p_area = $_GET['p_area'];


    $query = "SELECT * from `parking` WHERE `parking_area` = '$p_area'";

    $result = mysqli_query($con, $query);

    if(!$result){
        die("query Failed".mysqli_error());
                }
        else{
            $row = mysqli_fetch_assoc($result);

            print_r($result);

            if($row !== null) {
                // Your existing code to print and use $row
                print_r($row);
            } else {
                // Handle the case where $row is null
                echo "No data found for the given parking area.";
            }
        }
    
    }
?>

<h2 style="text-align:center">Update Parking</h2>
<table class="center">
<form action="" method="POST">
    <tr>
        <td>
        <div class="form-group">
                <label for="p_area" >Parking Area</label>
                <input type="text" name="p_area" class="form-control" value="<?php echo $row['parking_area']?>" >
            </div>
        </td>
    </tr>
    <tr>
        <td>
        <div class="form-group">
                <label for="p_availability" >Parking Availability</label>
                <input type="text" name="p_availability" class="form-control" value="<?php echo $row['parking_availability']?>">
            </div>
        </td>
    </tr>
    <tr>
        <td>
        <div class="form-group">
                <label for="p_status" >Parking Status</label>
                <input type="text" name="p_status" class="form-control" value="<?php echo $row['parking_status']?>">
            </div>
        </td>
    </tr>
</form>
</table>

<?php include '../Layout/allUserFooter.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>