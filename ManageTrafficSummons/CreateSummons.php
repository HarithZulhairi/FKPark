<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="CreateSummons.css">
    <title>Parking Booking Form</title>
</head>
<body>
    <?php include '../Layout/UKHeader.php'; ?>

    <main>
        <div class="booking-form-container">
            <h1>Summons Form</h1>
            <form action="QRBooking.php" method="POST">
                <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>
                </div>
                <div class="form-group">
                    <label for="violation">Violation:</label>
                    <select id="violation" name="violation" required>
                        <option value=""></option>
                        <option value="speed">Speeding</option>
                        <option value="nocomply">Not Complying</option>
                        <option value="accident">Accident</option>
                    </select>
                </div>
                <div class="form-group">
                <label for="vehicleNumPlate">Vehicle Number Plate:</label>
                <input type="vehicleNumPlate" id="vehicleNumPlate" name="vehicleNumPlate" required>
                </div>
                <div class="form-group">
                <label for="ukID">Staff ID:</label>
                <input type="ukID" id="ukID" name="ukID" required>
                </div>
                <button type="submit" class="confirm-button">Confirm Booking</button>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <?php include '../Layout/allUserFooter.php'; ?>
</body>
</html>