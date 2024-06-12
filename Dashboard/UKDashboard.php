<?php
session_start();
?>

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
            <!-- Summons Issued Card -->
            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">SUMMONS ISSUED BY YOU</p>
                    <span><img class="colored_image" style="width:50px; height:50px;" src="../resource/demerit1.png" alt="Demerit Total"></span>
                </div>
                <span class="text-primary font-weight-bold">
                    <?php
                    include '../DB_FKPark/dbcon.php';

                    $ukID = isset($_SESSION['userID']) ? $_SESSION['userID'] : null;
                    if ($ukID === null) {
                        die('Unit Keselamatan Staff ID not found in session. Please login again.');
                    }

                    // Fetch total demerit points from the database
                    $query = "SELECT COUNT(*) AS total_summons FROM summon WHERE uk_ID = $ukID";
                    $result = mysqli_query($con, $query);
                    $totalDemerit = 0;
                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $totalSummons = (int)$row['total_summons'];
                    }
                    echo $totalSummons;
                    ?>
                </span>
            </div>

            <!-- Speeding Total Card -->
            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">ALL SPEEDING SUMMONS</p>
                    <span><img class="colored_image" style="width:50px; height:50px;" src="../resource/demerit1.png" alt="Demerit Total"></span>
                </div>
                <span class="text-primary font-weight-bold">
                    <?php

                    // Fetch total demerit points from the database
                    $query = "SELECT COUNT(*) AS speed_summons FROM summon WHERE summon_violation = 'Speeding'";
                    $result = mysqli_query($con, $query);
                    $totalDemerit = 0;
                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $totalSummonsSpeed = (int)$row['speed_summons'];
                    }
                    echo $totalSummonsSpeed;
                    ?>
                </span>
            </div>

            <!-- Not Complying Card -->
            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">ALL NON COMPLIANCE SUMMONS</p>
                    <span><img class="colored_image" style="width:50px; height:50px;" src="../resource/demerit1.png" alt="Demerit Total"></span>
                </div>
                <span class="text-primary font-weight-bold">
                    <?php

                    // Fetch total demerit points from the database
                    $query = "SELECT COUNT(*) AS nc_summons FROM summon WHERE summon_violation = 'Not Complying'";
                    $result = mysqli_query($con, $query);
                    $totalDemerit = 0;
                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $totalSummonsNc = (int)$row['nc_summons'];
                    }
                    echo $totalSummonsNc;
                    ?>
                </span>
            </div>

            <!-- Accident Total Card -->
            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">ALL ACCIDENT SUMMONS</p>
                    <span><img class="colored_image" style="width:50px; height:50px;" src="../resource/demerit1.png" alt="Demerit Total"></span>
                </div>
                <span class="text-primary font-weight-bold">
                    <?php

                    // Fetch total demerit points from the database
                    $query = "SELECT COUNT(*) AS acc_summons FROM summon WHERE summon_violation = 'Accident'";
                    $result = mysqli_query($con, $query);
                    $totalDemerit = 0;
                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $totalSummonsAcc = (int)$row['acc_summons'];
                    }
                    echo $totalSummonsAcc;
                    ?>
                </span>
            </div>
        </div>

        <div class="charts">
            <div class="charts-card">
                <p class="chart-title">TOTAL SUMMONS</p>
                <div id="bar-chart"></div>
            </div>
            <div class="charts-card">
                <p class="chart-title">YOUR ACTIVITY</p>
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
        name: 'Total Summons By Type',
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
    colors: ['#246dec', '#cc3c43', '#367952'],
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
      categories: ['Speeding', 'Not Complying', 'Accident'],
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

  function updateBarChartData(totalSummonsSpeed, totalSummonsNc, totalSummonsAcc) {
    barChart.updateSeries([{
      data: [totalSummonsSpeed, totalSummonsNc, totalSummonsAcc]
    }]);
  }

  updateBarChartData(<?php echo $totalSummonsSpeed; ?>, <?php echo $totalSummonsNc; ?>, <?php echo $totalSummonsAcc; ?>);

  // AREA CHART
  const areaChartOptions = {
    series: [
      {
        name: 'Summons Issued',
        data: [],
      }
    ],
    chart: {
      height: 350,
      type: 'area',
      toolbar: {
        show: false,
      },
    },
    colors: ['#4f35a1'],
    dataLabels: {
      enabled: false,
    },
    stroke: {
      curve: 'smooth',
    },
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    markers: {
      size: 0,
    },
    yaxis: [
      {
        title: {
          text: 'Summons Issued',
        },
      }
      
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

  <?php
          // Fetch car and motorcycle bookings for each month
          $summonIssuedQuery = "SELECT COUNT(*) AS summons_issued, 
                                MONTH(summon_datetime) AS month 
                                FROM summon
                                WHERE uk_id = $ukID
                                GROUP BY MONTH(summon_datetime)
                                ";


          $summonsIssuedResult = mysqli_query($con, $summonIssuedQuery);

          // Initialize arrays to store data
          $summonsIssuedData = array_fill(0, 12, 0);

          while($row = mysqli_fetch_assoc($summonsIssuedResult)) {
              $monthIndex = intval($row['month']) - 1;
              $summonsIssuedData[$monthIndex] = intval($row['summons_issued']);
          }

      ?>

      // Function to update area chart data
      function updateAreaChartData(summonIssuedQuery) {
          console.log('Updating area chart data to:', summonIssuedQuery); // Debugging line
          areaChart.updateSeries([
              { data: summonIssuedQuery }

          ]);
      }

      updateAreaChartData(<?php echo json_encode($summonsIssuedData); ?>);

</script>

</body>
</html>