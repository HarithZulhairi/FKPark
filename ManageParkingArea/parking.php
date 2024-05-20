<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page</title>
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
                height: 200px;
                width: 300px;
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

    <table class="center" >
        <tr>
            <th style="width:500px;" >Parking Area</th>
            <th style="width:200px;">Availability</th>
            <th style="width:100px;padding-left:15px;">Action</th>
        </tr>

        <tr>
            <td>1</td>
            <td>2</td>
            <td>
                <div style="margin-top:5px; margin-bottom:5px; " class="button-container">
                        <a href="view-link-here" >
                                <button  style="width:100px; padding:10px 10px;"type="view">View</button>
                        </a>
                    </div>
            </td>
        </tr>
        
    </table>

    </div>

    
        
    </main>

    <?php include '../Layout/allUserFooter.php'; ?>
</body>
</html>