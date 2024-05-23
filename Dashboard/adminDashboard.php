<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../Dashboard/styles.css">
</head>
<body>

<?php include '../Layout/adminHeader.php'; ?>
<div class="grid-container">

    <!-- Main -->
    <main class="main-container">
        <div class="main-title">
            <p class="font-weight-bold">DASHBOARD</p>
        </div>

        <div class="main-cards">

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">TOTAL PARKING SPACES</p>
                    <span><img class="colored_image" style="width:50px; height:50px;" src="../resource/parking.png" alt="Parking"></span>
                </div>
                <span class="text-primary font-weight-bold">249</span>
            </div>

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">OCCUPIED PARKING </p>
                    <span><img class="colored_image" style="width:50px; height:50px;" src="../resource/occupied.png" alt="Occupied"></span>
                </div>
                <span class="text-primary font-weight-bold">83</span>
            </div>

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">AVAILABLE PARKING</p>
                    <span><img  class="colored_image" style="width:50px; height:50px;" src="../resource/available.png" alt="Available"></span>
                </div>
                <span class="text-primary font-weight-bold">79</span>
            </div>

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">QR SCANS TODAY</p>
                    <span><img class="colored_image" style="width:50px; height:50px;" src="../resource/qr_code.png" alt="QR Code"></span>
                </div>
                <span class="text-primary font-weight-bold">56</span>
            </div>

        </div>

        <div class="charts">

            <div class="charts-card">
                <p class="chart-title">TOTAL PARKING SPACES</p>
                <div id="bar-chart"></div>
            </div>

            <div class="charts-card">
                <p class="chart-title">QR SCANS TODAY</p>
                <div id="area-chart"></div>
            </div>

        </div>
    </main>
    <!-- End Main -->

</div>

<!-- Scripts -->
<!-- ApexCharts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
<!-- Custom JS -->
<script src="../Dashboard/scripts.js"></script>
<?php include '../Layout/allUserFooter.php'; ?>
</body>
</html>
