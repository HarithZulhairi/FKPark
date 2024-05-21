<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            background-color: #f4f4f4;
        }

        .container2 {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .center-table {
            width: 100%;
            max-width: 600px;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .center-table h1 {
            margin: 0;
            padding: 20px;
            background-color: #333;
            color: #fff;
            text-align: center;
        }

        .center-table img {
            display: block;
            margin: 0 auto;
            margin-top: 20px;
        }

        .center-middle {
            padding: 20px;
        }

        .center-middle p {
            font-weight: bold;
            font-size: 18px;
            color: #333;
            text-align: center;
            margin-bottom: 10px;
        }

        .radio-group {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .radio-group label {
            padding-top: 8px;
            margin-left: 10px;
            margin-right: 20px;
            font-size: 16px;
            color: #333;
        }

        .radio-group input[type="radio"] {
            margin-left: 10px;
        }

        label {
            display: block;
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="file"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .submit-btn {
            text-align: center;
            padding-bottom: 20px;
        }

        .submit-btn input[type="submit"] {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php include '../Layout/studentHeader.php'; ?>

    <div class="container2">
        <table border="0" cellspacing="0" cellpadding="0" class="center-table">
            <tr>
                <td colspan="2">
                    <h1>Registration Form</h1>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <img src="FKPARK.png" alt="parking" width="150" height="150">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <form action="Registration.php" method="post" enctype="multipart/form-data">
                        <div class="center-middle">
                            <p>Select Vehicle Type</p>
                            <div class="radio-group">
                                <input type="radio" id="car" name="vehicleType" value="Car">
                                <label for="car">Car</label>
                                <input type="radio" id="motorcycle" name="vehicleType" value="Motorcycle">
                                <label for="motorcycle">Motorcycle</label>
                            </div>
                            <label for="numPlate">Number Plate</label>
                            <input type="text" id="numPlate" name="numPlate" required>
                            <label for="grantFile">Upload Grant File</label>
                            <input type="file" id="grantFile" name="grantFile" required>
                        </div>
                        <div class="center-middle">
                            <label for="comment">Comments</label>
                            <textarea rows="4" id="comment" name="comment" form="comment" placeholder="Enter text here"></textarea>
                        </div>
                        <div class="submit-btn">
                            <input type="submit" value="Submit">
                        </div>
                    </form>
                </td>
            </tr>
        </table>
    </div>

    <?php include '../Layout/allUserFooter.php'; ?>
</body>
</html>
