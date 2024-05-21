<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Booking Page</title>
    <style>
        table.center {
          margin-left: auto; 
          margin-right: auto;
        }

        .button-container {
                display: flex;
                justify-content: center;
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

            .button-container button[type="view"]:hover {
                background-color: #0000FF;
            }

            .button-container button[type="edit"]:hover {
                background-color: green;
            }

            .button-container button[type="delete"]:hover {
                background-color: red;
            }

            #list{
                margin-top:30px;

            }
            td{
                justify-content:center;
                text-align:center;
                
            }
            th{
                text-align:center;
            }
            
            .box1 h2{
                float:left;
            }
            .box1 button{
                float:right;
            }

            h6{
                text-align:center;
                color:red;
            }

    </style>
</head>
<body>

    <?php include '../Layout/adminHeader.php'; ?>
    <?php include '../dbcon.php'; ?>
    <main>


    <div class="box1" style="display: flex; align-items: center; justify-content:center;padding-top:50px;">
        <h2 style="margin-right:650px;">List of Parking</h2>
        <div class="button-container" >
                    <a href="#" >
                              <button type="submit" class="button btn-primary "data-bs-toggle="modal" data-bs-target="#parkingexampleModal">Add New Parking</button>
                          </a>
        </div>
        <div class=" button-container" >
                    <a href="#" >
                              <button type="submit" data-bs-toggle="modal" data-bs-target="#eventexampleModal">Add Event</button>
                          </a>
        </div>

    </div>

    <div id="list">
        <div class="container">
        <table class="table table-hover table-bordered table-striped" >
            <tr>
                <th style="width:280px;">Area</th>
                <th style="width:300px;">Action</th>
                <th style="width:180px;">Status</th>
            </tr>

            <tbody>
            <?php
                        $query = "select * from `parking`";

                        $result = mysqli_query($con, $query);

                        if(!$result){
                            die("query Failed".mysqli_error());
                        }
                        else{
                            while($row = mysqli_fetch_assoc($result)){

                                ?>
                                    <tr>
                                        <td><?php echo$row['parking_area']; ?></td>
                                        <td style="border-collapse: collapse;display: flex; align-items: center;">
                                            <div style="margin:10px 10px;" class="button-container">
                                                <a href="add-link-here" >
                                                        <button type="edit">Edit</button>
                                                    </a>
                                            </div>
                                                <div style="margin:10px 10px;" class="button-container">
                                                    <a href="event-link-here" >
                                                        <button type="view">View</button>
                                                    </a>
                                                </div>
                                                <div  style="margin:10px 10px;" class="button-container">
                                                    <a href="add-link-here" >
                                                        <button type="delete">Delete</button>
                                                    </a>
                                                </div>
                                                    
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

        <?php
                if(isset($_GET['message'])){
                    echo "<h6>" .$_GET['message'] . "</h6>";
                }
            ?>

    </div>



    
    </main>


    <?php include '../Layout/allUserFooter.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

 <!-- Modal -->
 <form action="../DB_FKPark/insert_data.php" method="post" >
 <div class="modal fade" id="parkingexampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" >Add New Parking</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         
        </button>
      </div>
      <div class="modal-body">
        
            <div class="form-group">
                <label for="p_area" >Parking Area</label>
                <input type="text" name="p_area" class="form-control">
            </div>
            <div class="form-group">
                <label for="p_availability" >Parking Availability</label>
                <input type="text" name="p_availability" class="form-control">
            </div>
            <div class="form-group">
                <label for="p_status" >Parking Status</label>
                <input type="text" name="p_status" class="form-control">
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-success" name="add_parking" value="ADD">
      </div>
    </div>
  </div>
</div>
</form>

 <!-- Modal -->
 <form action="../DB_FKPark/insert_data.php" method="post">
 <div class="modal fade" id="eventexampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" >Add New Parking</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         
        </button>
      </div>
      <div class="modal-body">
        
            <div class="form-group">
                <label for="event_name" >Event Name</label>
                <input type="text" name="event_name" class="form-control">
            </div>
            <div class="form-group">
                <label for="event_date" >Event Date</label>
                <input type="date" name="event_date" class="form-control">
            </div>
            <div class="form-group">
                <label for="event_start" >Event Start</label>
                <input type="time" name="event_start" class="form-control">
            </div>
            <div class="form-group">
                <label for="event_end" >Event End</label>
                <input type="time" name="event_end" class="form-control">
            </div>
            <div class="form-group">
                <label for="event_place" >Event Place</label>
                <input type="text" name="event_place" class="form-control">
            </div>
            <div class="form-group">
                <label for="event_description" >Event Description</label>
                <input type="text" name="event_description" class="form-control">
            </div>
            
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-success" name="add_event" value="ADD">
      </div>
    </div>
  </div>
</div>
</form>
</body>


</html>