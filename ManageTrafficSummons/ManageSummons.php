<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="ManageSummons.css">
</head>

<body>
    <?php include '../Layout/UKHeader.php'; ?>
    
    <div class="logoUK">
        <img src="../resource/logUK1.png" alt="Logo Unit Keselamatan">
    </div>
    
    <div class="button-container"></div>
    
    <div class="button-container"><a href="destination.php" class="button">CREATE SUMMONS</a></div>    
    <div class="table-container">
        
        <table>
            <tr>
                <th style="width:150px;" >Summons ID</th>
                <th style="width:500px;">Summons Violation</th>
                <th style="width:200px">Vehicle Plate Number</th>
                <th style="width:200px;">Action</th>
            </tr>
            <tbody>
            <?php
                        $query = "select * from `summons`";

                        $result = mysqli_query($con, $query);

                        if(!$result){
                            die("query Failed".mysqli_error());
                        }
                        else{
                            while($row = mysqli_fetch_assoc($result)){

                                ?>
                                    <tr>
                                        <td><?php echo$row['summons_ID']; ?></td>
                                        <td><?php echo$row['summons_ID']; ?></td>
                                        <td style="border-collapse: collapse;display: flex; align-items: center;">
                                                <div style="margin:10px 10px;" class="button-container">
                                                    <a href="event-link-here" >
                                                        <button type="view">View</button>
                                                    </a>
                                                </div>

                                                <a href="../ManageParkingArea/update_page_1.php?id=<?php echo$row['parking_ID']; ?>" class="btn btn-success" style="margin-right:40px;" >Update</a>
                                                <a href="../ManageParkingArea/delete_page.php?id=<?php echo$row['parking_ID']; ?>" class="btn btn-danger">Delete</a>
                                                    
                                        </td>
                                        <td><?php echo$row['parking_status']; ?></td>
                                    </tr>
                                <?php
                            }
                        }
                    ?>

            </tbody>

                
                   


        
    </table>
    </div>
    



    <?php include '../Layout/allUserFooter.php'; ?>


</body>
</html>