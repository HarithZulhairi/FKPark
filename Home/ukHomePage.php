<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creation to Market</title>
    <link rel="stylesheet" href="HomePage.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
</head>
<body>
    <?php 
    session_start();
    include '../Layout/UKHeader.php'; 
    ?>

    <div class="profile">
        <?php
        if(isset($_SESSION['userProfile'])) {
            $profileImage = $_SESSION['userProfile'];
        } else {
            $profileImage = '../resource/defaultProfile.jpg'; // Default profile image
        }
        ?>
        <img src="<?php echo $profileImage; ?>" alt="User Profile Picture" class="profile-picture">
        <span class="username">Welcome, User!</span>
    </div>

    <main class="container">
        <section class="text-section">
            <h1>FKPARK</h1>
            <p>They Are Waiting For You.</p>
            <p>Approve Now.</p>
            <button onclick="window.location.href='../ManageRegistration/VehicleApproval.php'">Approve</button>
        </section>
        <section class="image-section">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="../resource/illustration.jpg" alt="Parking lot 1 at FKPARK"></div>
                    <div class="swiper-slide"><img src="../resource/FKPark_Map.png" alt="Parking lot 2 at FKPARK"></div>
                    <div class="swiper-slide"><img src="../resource/parkingFkom3.jpg" alt="Parking lot 3 at FKPARK"></div>
                </div>
                <!-- Add Pagination -->
                <!-- Add Navigation -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </section>
    </main>

    <?php include '../Layout/allUserFooter.php'; ?>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            spaceBetween: 10,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            loop: true,
        });

        
    </script>
</body>
</html>
