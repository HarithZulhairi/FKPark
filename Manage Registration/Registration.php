<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Registration.css">
    <title>Registration</title>
</head>
<body>
    <div class="container2">
        <table border="1" class="center-table">
            <tr>
                <td colspan="2" style="text-align: center;">
                    <h1>Registration Form</h1>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <img src="FKPARK.png" alt="parking" width="150" height="150">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <form action="Registration.php">
						<div class="center-middle">
							<p>Select Vehicle Type</p>
							<div class="radio-group">
								<input type="radio" id="car" name="vehicleType" value="Car">
								<label for="car">Car</label>
								<input type="radio" id="motorcycle" name="vehicleType" value="Motorcycle">
								<label for="motorcycle">Motorcycle</label>
							</div>
							<label for="numPlate">Number Plate</label>
							<input type="text" id="numPlate" name="numPlate"><br><br>
							<label for="grantFile">Upload Grant File</label><br>
							<input type="file" id="grantFile" name="GrantFile"><br>
						</div>
					</form>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <form action="Registration.php" id="comment">
                        <textarea rows="4" cols="50" name="comment" form="comment">Enter text here</textarea>
                    </form>
					
                </td>
            </tr>
        </table>
		<br>
		<input type="submit" value="Submit">

    </div>
</body>
</html>
