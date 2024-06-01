
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

<?php include '../Layout/studentHeader.php'; ?>
<div class="grid-container">

    <!-- Main -->
    <main class="main-container">
        <div class="main-title">
            <p class="font-weight-bold">DASHBOARD</p>
        </div>

        <div class="main-cards">

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">TOTAL BOOKING PER DAY</p>
                    <span ><img class="colored_image" style="width:50px; height:50px;" src="../resource/book_online.png" alt="Parking"></span>
                </div>
                <!-- Update the total parking spaces count with PHP -->
                <span class="text-primary font-weight-bold">
                    <?php
                    include '../DB_FKPark/dbcon.php'; // Include dbcon.php to establish database connection

                    // Fetch count of parking spaces from the database
                    $query = "SELECT COUNT(*) AS total_booking FROM parking";
                    $result = mysqli_query($con, $query);

                    // Initialize a variable to store the count of parking spaces
                    $totalSpacesCount = 0;

                    // Check if the query was successful and fetch the count
                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $totalSpacesCount = (int)$row['total_booking'];
                    }

                    echo $totalSpacesCount; // Output the total parking spaces count
                    ?>
                </span>
            </div>

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">OCCUPIED PARKING </p>
                    <span><img class="colored_image" style="width:50px; height:50px;" src="../resource/unavailable.png" alt="Occupied"></span>
                </div>
                <span class="text-primary font-weight-bold">83</span>
            </div>

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">AVAILABLE PARKING</p>
                    <span><img  class="colored_image" style="width:50px; height:50px;" src="../resource/check.png" alt="Available"></span>
                </div>
                <span class="text-primary font-weight-bold">79</span>
            </div>

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">EVENT TODAY</p>
                    <span><img class="colored_image" style="width:50px; height:50px;" src="../resource/event.png" alt="QR Code"></span>
                </div>
                <span class="text-primary font-weight-bold">56</span>
            </div>

        </div>

        <div class="charts">

            <div class="charts-card">
                <p class="chart-title">OCCUPIED PARKING PER AREA</p>
                <div id="bar-chart"></div>
            </div>

            <div class="charts-card">
                <p class="chart-title">BOOKED PARKING</p>
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
  // ---------- CHARTS ----------

  // BAR CHART
  const barChartOptions = {
    series: [
      {
        name: 'Total Parking Spaces',
        data: [], // Initialize with empty data
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

  // Function to update bar chart data with total parking spaces count
  function updateBarChartData(totalSpacesCount) {
    console.log('Updating bar chart data with total parking spaces count:', totalSpacesCount); // Debugging line
    barChart.updateSeries([{
      data: [totalSpacesCount] // Update with the total parking spaces count
    }]);
  }

  // Call the function to update bar chart data with total parking spaces count
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

  // Function to update area chart data
  function updateAreaChartData(newPurchaseData, newSalesData) {
    console.log('Updating area chart data to:', newPurchaseData, newSalesData); // Debugging line
    areaChart.updateSeries([
      { data: newPurchaseData },
      { data: newSalesData }
    ]);
  }

  // Example of updating area chart data after 3 seconds
  setTimeout(() => {
    updateAreaChartData([31, 40, 28, 51, 42, 109, 100], [40, 32, 45, 32, 34, 52, 41]);
  }, 3000);
</script>



</body>
</html>
