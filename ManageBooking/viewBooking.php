<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="viewBooking.css">
    <title>Parking Booking Form</title>
</head>
<body>
    <?php include '../Layout/studentHeader.php'; ?>

    <main>
        <h2 class="title-view">List booking</h2>
        <div class="view-container">
            <table class="view-table">
                <tr class="view-table-header">
                    <th>No</th>
                    <th>Parking slot</th>
                    <th colspan="2">Action</th>
                </tr>
                <tr class="view-table-content">
                    <td>1</td>
                    <td>B113</td>
                    <td><a href="#">Edit</a></td>
                    <td><a href="#">Delete</a></td>
                </tr>

            </table>
        </div>
    </main>

    <?php include '../Layout/allUserFooter.php'; ?>
</body>
</html>
