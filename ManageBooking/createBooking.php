<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="createBooking.js"></script>
    <script src="https://kit.fontawesome.com/449b7d4b66.js" crossorigin="anonymous"></script>
    <title>Booking Page</title>

    <link rel="stylesheet" href="createBooking.css">

</head>
<body>
    <?php include '../Layout/studentHeader.php'; ?>

    <main>
        <div class="booking-search">
            <div class="search-bar">
                <i class="fa-solid fa-magnifying-glass fa-2x" style="padding-top: 5px"></i>
                <input type="text" placeholder="Search parking spot name">
                <button><i class="fa-solid fa-filter" style="padding-right: 8px"></i>Show Vacant</button>
                <button>QR</button>
            </div>
        </div>

        <div class="create-booking">
            <div class="parking-layout">
                <h1>Select Your Parking</h1>
                <img src="parking-layout.png" alt="Parking Layout">
            </div>

            <div class="tabs">
                <button class="tab-button tab-active" data-section="sectionA" onclick="showTab('sectionA', this)">Parking Section A</button>
                <button class="tab-button" data-section="sectionB" onclick="showTab('sectionB', this)">Parking Section B</button>
                <button class="tab-button" data-section="sectionC" onclick="showTab('sectionC', this)">Parking Section C</button>
                <div class="tab-indicator"></div>
            </div>

            <div id="sectionA" class="tab-content active">
                <table>
                    <tr>
                        <th>Parking Spot</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td>A001</td>
                        <td><a href="confirmBooking.php?parkingSpot=A001" class="book-link">Book</a></td>
                    </tr>
                    <tr>
                        <td>A002</td>
                        <td><a href="confirmBooking.php?parkingSpot=A002" class="book-link">Book</a></td>
                    </tr>
                </table>
            </div>

            <div id="sectionB" class="tab-content">
                <table>
                    <tr>
                        <th>Parking Spot</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td>B001</td>
                        <td><a href="confirmBooking.php?parkingSpot=B001" class="book-link">Book</a></td>
                    </tr>
                    <tr>
                        <td>B002</td>
                        <td><a href="confirmBooking.php?parkingSpot=B002" class="book-link">Book</a></td>
                    </tr>
                </table>
            </div>

            <div id="sectionC" class="tab-content">
                <table>
                    <tr>
                        <th>Parking Spot</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td>C001</td>
                        <td><a href="confirmBooking.php?parkingSpot=C001" class="book-link">Book</a></td>
                    </tr>
                    <tr>
                        <td>C002</td>
                        <td><a href="confirmBooking.php?parkingSpot=C002" class="book-link">Book</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </main>

    <?php include '../Layout/allUserFooter.php'; ?>
</body>
</html>
