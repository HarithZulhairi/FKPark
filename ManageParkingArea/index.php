<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        table.center {
          margin-left: auto; 
          margin-right: auto;
        }

        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            }

            h1{
                text-align: center;
            }

            .square {
                height: 220px;
                width: 350px;
                background-color: #254D98;
                border-radius: 20%;
                color:white;
                padding-top:20px;
                padding-left:20px;
                padding-right:20px;
                
                }

                .button-container {
                display: flex;
                justify-content: center;
                margin-top: 30px;
                
            }

            .button-container button {
                margin: 0 10px;
                padding: 15px 15px;
                font-size: 16px;
                background-color:  #17252A;
                color: white;
                font-weight: bold;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }


            .button-container button[type="book"]:hover {
                background-color: #0000FF;
            }

            .button-container button[type="view"]:hover {
                background-color: #0000FF;
            }

            #ParkingList{
                
               
            }

            main{
                padding-bottom:20px;
            }
            #promote{
                background-color:#254D98;
                height:100px;
                width: 100%;
                margin-bottom:40px;
            }
            th{
                font-size:20px;
                text-align:left;
            }

            #promote{
                color:white;
                font-size:24px;
                justify-content: center; /* Center text horizontally */
                gap: 160px; /* Adjust space between paragraphs as needed */
            }

    </style>
</head>
<body>

    <?php include '../Layout/adminHeader.php'; ?>
    <?php include '../DB_FKPark/createDB.php'; ?>
   
    <main>

    <h1>Welcome to FKPark</h1>

    <div id="welcome" >
        <table class="center" style="margin-top:0px;" >
            <tr>
                <td style="padding-right:50px;"><img src="../resource/illustration.jpg" alt="illustration" width="370" height="400"></td>
                <td>
                <div class="square">
                    <h3>Book Now</h3>
                    <p>You are only 60 seconds from reserving a parking space!</p>
                    <div class="button-container">
                    <a href="book-link-here" >
                              <button type="book">BOOK NOW</button>
                          </a>
                    </div>
                    
                </div>
                </td>

            </tr>
        </table>
    </div>

    <div id="promote" style="display: flex; align-items: center;">
            <p><i>Effortless Parking, Every Time!</i></p>
            <p><i>Swift Parking, Seamless Experience!</i></p>
            <p><i>Park with Ease, Leave with Peace!</i></p>
    </div>

    <div id="ParkingList">
        <div class="container">
            <table class="table table-hover table-bordered table-striped" >
                <tr>
                    <th style="width:500px;" >Parking Area</th>
                    <th style="width:200px;">Availability</th>
                    <th style="width:100px;padding-left:15px;">Action</th>
                </tr>
                <tbody>
                    <?php
                        $query2 = "select * from 'parking'";

                        $result = mysqli_query($con, $query2);

                        if(!$result){
                            die("query Failed".mysqli_error());
                        }
                        else{
                            while($row = mysqli_fetch_assoc($result)){

                                ?>
                                    <h4>hello</h4>
                                <?php
                            }
                        }
                    ?>
                    <tr>
                        <td>A001</td>
                        <td>17</td>
                        <td>
                            <div style="margin-top:5px; margin-bottom:5px; " class="button-container">
                                    <a href="view-link-here" >
                                            <button  style="width:100px; padding:10px 10px;"type="view">View</button>
                                    </a>
                                </div>
                        </td>
                    </tr>

                    <tr>
                        <td>A002</td>
                        <td>20</td>
                        <td>
                            <div style="margin-top:5px; margin-bottom:5px; " class="button-container">
                                    <a href="view-link-here" >
                                            <button  style="width:100px; padding:10px 10px;"type="view">View</button>
                                    </a>
                                </div>
                        </td>
                    </tr>
                </tbody>


        
    </table>
    </div>
    

    </div>

    
        
    </main>
   
    <?php include '../Layout/allUserFooter.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>