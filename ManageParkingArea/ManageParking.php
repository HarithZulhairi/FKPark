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


    </style>
</head>
<body>

    <?php include '../Layout/adminHeader.php'; ?>
   
    <main>


    <div style="display: flex; align-items: center; justify-content:center;padding-top:50px;">
        <h2 style="margin-right:270px;">List of Parking</h2>
        <div class="button-container">
                    <a href="add-link-here" >
                              <button type="submit">Add New Parking</button>
                          </a>
        </div>
        <div class="button-container">
                    <a href="event-link-here" >
                              <button type="submit">Add Event</button>
                          </a>
        </div>

    </div>

    <div id="list">
        <table class="center" >
            <tr>
                <th style="height:50px;width:180px;">Area</th>
                <th style="width:400px;">Action</th>
                <th style="width:180px;">Status</th>
            </tr>
            <tr>
                <td style="margin-left:50px;">A-100</td>
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
                <td>Stats</td>
            </tr>

        </table>

    </div>



    
    </main>

    <?php include '../Layout/allUserFooter.php'; ?>
</body>
</html>