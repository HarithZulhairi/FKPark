<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Student Dashboard</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../Dashboard/adminDashboard.css">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .grid-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-container {
            flex: 1;
        }
    </style>
</head>
<body>

<?php include '../Layout/UKHeader.php'; ?>
<div class="grid-container">

    <!-- Main -->
    <main class="main-container">
        <div class="main-title">
            <p class="font-weight-bold">DASHBOARD</p>
        </div>

        <div class="main-cards">
            <!-- Demerit Total Card -->
            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">DEMERIT TOTAL</p>
                    <span><img class="colored_image" style="width:50px; height:50px;" src="../resource/demerit1.png" alt="Demerit Total"></span>
                </div>
                <span class="text-primary font-weight-bold">
                    <?php
                    include '../DB_FKPark/dbcon.php';

                    // Fetch total demerit points from the database
                    $query = "SELECT SUM(summon_demerit) AS total_demerit FROM summon";
                    $result = mysqli_query($con, $query);
                    $totalDemerit = 0;
                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $totalDemerit = (int)$row['total_demerit'];
                    }
                    echo $totalDemerit;
                    ?>
                </span>
            </div>

            <!-- Vehicle Registered Card -->
            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">VEHICLE REGISTERED</p>
                    <span><img class="colored_image" style="width:50px; height:50px;" src="../resource/available1.png" alt="Vehicle Registered"></span>
                </div>
                <span class="text-primary font-weight-bold">
                    <?php
                    // Fetch count of distinct vehicle types from the database
                    $query = "SELECT COUNT(DISTINCT vehicle_type) AS vehicle_count FROM vehicle";
                    $result = mysqli_query($con, $query);
                    $vehicleCount = 0;
                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $vehicleCount = (int)$row['vehicle_count'];
                    }
                    echo $vehicleCount;
                    ?>
                </span>
            </div>

            <!-- Registration Status Card -->
            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">REGISTRATION STATUS</p>
                    <span><img class="colored_image" style="width:50px; height:50px;" src="../resource/check1.png" alt="Registration Status"></span>
                </div>
                <span class="text-primary font-weight-bold">
                    <?php
                    // Fetch count of approved registrations from the database
                    $query = "SELECT COUNT(*) AS approved_count FROM approval WHERE approval_status = 'Approved'";
                    $result = mysqli_query($con, $query);
                    $approvedCount = 0;
                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $approvedCount = (int)$row['approved_count'];
                    }
                    echo $approvedCount;
                    ?>
                </span>
            </div>

            <!-- Total Booking Card -->
            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">TOTAL BOOKING</p>
                    <span><img class="colored_image" style="width:50px; height:50px;" src="../resource/parking1.png" alt="Total Booking"></span>
                </div>
                <span class="text-primary font-weight-bold">
                    <?php
                    // Fetch count of total bookings made by students
                    $query = "SELECT COUNT(*) AS total_booking FROM booking";
                    $result = mysqli_query($con, $query);
                    $totalBooking = 0;
                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $totalBooking = (int)$row['total_booking'];
                    }
                    echo $totalBooking;
                    ?>
                </span>
            </div>
        </div>

        <div class="charts">
            <div class="charts-card">
                <p class="chart-title">TOTAL BOOKING</p>
                <div id="bar-chart"></div>
            </div>
            <div class="charts-card">
                <p class="chart-title">DEMERIT TOTAL</p>
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
<script>
  // BAR CHART
  const barChartOptions = {
    series: [
      {
        name: 'Total Parking Spaces',
        data: [],
      },
    ],
    chart: {
      type: 'bar',
      height: 350,
      toolbar: {
        show: false,
      },
    },
    colors: ['#246dec'],
    plotOptions: {
      bar: {
        distributed: true,
        borderRadius: 4,
        horizontal: false,
        columnWidth: '40%',
      },
    },
    dataLabels: {
      enabled: false,
    },
    legend: {
      show: false,
    },
    xaxis: {
      categories: ['Total Parking Spaces'],
    },
    yaxis: {
      title: {
        text: 'Count',
      },
    },
  };

  const barChart = new ApexCharts(
    document.querySelector('#bar-chart'),
    barChartOptions
  );
  barChart.render();

  function updateBarChartData(totalSpacesCount) {
    barChart.updateSeries([{
      data: [totalSpacesCount]
    }]);
  }

  updateBarChartData(<?php echo $totalSpacesCount; ?>);

  // AREA CHART
  const areaChartOptions = {
    series: [
      {
        name: 'Purchase Orders',
        data: [0, 0, 0, 0, 0, 0, 0],
      },
      {
        name: 'Sales Orders',
        data: [0, 0, 0, 0, 0, 0, 0],
      },
    ],
    chart: {
      height: 350,
      type: 'area',
      toolbar: {
        show: false,
      },
    },
    colors: ['#4f35a1', '#246dec'],
    dataLabels: {
      enabled: false,
    },
    stroke: {
      curve: 'smooth',
    },
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
    markers: {
      size: 0,
    },
    yaxis: [
      {
        title: {
          text: 'Purchase Orders',
        },
      },
      {
        opposite: true,
        title: {
          text: 'Sales Orders',
        },
      },
    ],
    tooltip: {
      shared: true,
      intersect: false,
    },
  };

  const areaChart = new ApexCharts(
    document.querySelector('#area-chart'),
    areaChartOptions
  );
  areaChart.render();

  function updateAreaChartData(newPurchaseData, newSalesData) {
    areaChart.updateSeries([
      { data: newPurchaseData },
      { data: newSalesData }
    ]);
  }

  setTimeout(() => {
    updateAreaChartData([31, 40, 28, 51, 42, 109, 100], [40, 32, 45, 32, 34, 52, 41]);
  }, 3000);
</script>
<script src="studDashboard.js"></script>
</body>
</html>