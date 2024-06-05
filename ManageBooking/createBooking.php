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
        <div class="create-booking">
            <div class="parking-layout">
                <h1>Select Your Parking</h1>
                <img src="../resource/FKPark_Map.png" alt="Parking Layout">
            </div>

            <div class="booking-filter">
                <div class="filter-bar">
                    <button><i class="fa-solid fa-filter" style="padding-right: 8px"></i>Show Vacant Today</button>
                </div>
            </div>

            <div class="tabs">
                <button class="tab-button tab-active" data-section="sectionA" onclick="showTab('sectionA', this)">Parking Section B1</button>
                <button class="tab-button" data-section="sectionB" onclick="showTab('sectionB', this)">Parking Section B2</button>
                <button class="tab-button" data-section="sectionC" onclick="showTab('sectionC', this)">Parking Section B3</button>
                <button class="tab-button" data-section="sectionD" onclick="showTab('sectionD', this)">Parking Section M1</button>
                <div class="tab-indicator"></div>
            </div>

            <div id="sectionA" class="tab-content active">
                <table>
                    <tr>
                        <th>Parking Spot</th>
                        <th>Action</th>
                    </tr>
                    <?php for ($i = 1; $i <= 20; $i++) { ?>
                        <tr>
                            <td>B1<?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></td>
                            <td><a href="confirmBooking.php?parkingSpot=B1<?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?>" class="book-link">Book</a></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

            <div id="sectionB" class="tab-content">
                <table>
                    <tr>
                        <th>Parking Spot</th>
                        <th>Action</th>
                    </tr>
                    <?php for ($i = 1; $i <= 20; $i++) { ?>
                        <tr>
                            <td>B2<?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></td>
                            <td><a href="confirmBooking.php?parkingSpot=B2<?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?>" class="book-link">Book</a></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

            <div id="sectionC" class="tab-content">
                <table>
                    <tr>
                        <th>Parking Spot</th>
                        <th>Action</th>
                    </tr>
                    <?php for ($i = 1; $i <= 20; $i++) { ?>
                        <tr>
                            <td>B3<?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></td>
                            <td><a href="confirmBooking.php?parkingSpot=B3<?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?>" class="book-link">Book</a></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

            <div id="sectionD" class="tab-content">
                <table>
                    <tr>
                        <th>Parking Spot</th>
                        <th>Action</th>
                    </tr>
                    <?php for ($i = 1; $i <= 40; $i++) { ?>
                        <tr>
                            <td>M1<?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></td>
                            <td><a href="confirmBooking.php?parkingSpot=M1<?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?>" class="book-link">Book</a></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </main>

    <?php include '../Layout/allUserFooter.php'; ?>
</body>
</html>
