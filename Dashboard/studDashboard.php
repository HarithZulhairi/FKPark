<?php
session_start(); // Ensure the session is started
include '../DB_FKPark/dbcon.php';

$con = mysqli_connect("localhost", "root", "", "fkpark");



// Check if the user is logged in and the user ID is set in the session
$studentID = isset($_SESSION['userID']) ? $_SESSION['userID'] : null;

// If the student ID is not set, redirect to the login page
if ($studentID === null) {
    die('Student ID not found in session. Please login again.');
}
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
            padding: 20px;
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

              <!-- Display Total Summon Count -->
        <div class="card">
            <div class="card-inner">
                <p class="text-primary">TOTAL SUMMON</p>
                <span><img class="colored_image" style="width:50px; height:50px;" src="../resource/sad.png" alt="Sad"></span>
            </div>
            <span class="text-primary font-weight-bold">
                <?php
                $querySummons = "SELECT COUNT(*) AS summon_count 
                                 FROM Summon s
                                 JOIN Vehicle v ON s.vehicle_numPlate = v.vehicle_numPlate
                                 JOIN Student st ON v.student_ID = st.student_ID
                                 WHERE st.student_ID = ?";
                
                $stmtSummons = mysqli_prepare($con, $querySummons);
                mysqli_stmt_bind_param($stmtSummons, 'i', $studentID);
                mysqli_stmt_execute($stmtSummons);
                $resultSummons = mysqli_stmt_get_result($stmtSummons);

                $totalSummons = 0;

                if ($resultSummons && mysqli_num_rows($resultSummons) > 0) {
                    $rowSummons = mysqli_fetch_assoc($resultSummons);
                    $totalSummons = (int)$rowSummons['summon_count'];
                }

                echo $totalSummons;
                ?>
            </span>
        </div>


        <div class="card">
            <div class="card-inner">
                <p class="text-primary">TOTAL DEMERIT</p>
                <span>
                    <img class="colored_image" style="width:50px; height:50px;" src="../resource/demerit.png" alt="Demerit">
                </span>
            </div>
            <!-- Update the total demerit points count with PHP -->
            <span class="text-primary font-weight-bold">
                <?php
                // Fetch the sum of demerit points from the summon table
                $query = "SELECT SUM(summon_demerit) AS total_demerit FROM summon";
                $result = mysqli_query($con, $query);

                // Initialize a variable to store the total demerit points
                $totalDemeritPoints = 0;

                // Check if the query was successful and fetch the sum
                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $totalDemeritPoints = (int)$row['total_demerit'];
                }

                echo $totalDemeritPoints;
                ?>
            </span>
        </div>




        <div class="card">
            <div class="card-inner">
                <p class="text-primary">TOTAL VEHICLE REGISTERED</p>
                <span><img class="colored_image" style="width:50px; height:50px;" src="../resource/available1.png" alt="QR Code"></span>
            </div>
            <span class="text-primary font-weight-bold">
                <?php
                    // Use prepared statement to prevent SQL injection
                    $query5 = "SELECT COUNT(*) AS vehicle_count FROM vehicle WHERE student_ID = ?";
                    $stmt5 = mysqli_prepare($con, $query5);
                    mysqli_stmt_bind_param($stmt5, 'i', $studentID);
                    mysqli_stmt_execute($stmt5);
                    $result5 = mysqli_stmt_get_result($stmt5);

                    $totalRegisteredCount = 0;

                    if ($result5 && mysqli_num_rows($result5) > 0) {
                        $row5 = mysqli_fetch_assoc($result5);
                        $totalRegisteredCount = (int)$row5['vehicle_count'];
                    }

                    echo $totalRegisteredCount;

                    // Close the statement and the connection
                    mysqli_stmt_close($stmt5);
                ?>
            </span>
        </div>

              

        </div>

        <div class="charts">

              <div class="charts-card">
                  <p class="chart-title">TOTAL DEMERIT</p>
                  <div id="bar-chart"></div>
              </div>

            <div class="charts-card">
                <p class="chart-title">TOTAL SUMMON</p>
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

    // BAR CHART FOR DEMERIT POINTS
    const barChartOptions = {
        series: [
            {
                name: 'Total Demerit Points',
                data: [], //Initialize with empty data
            },
        ],
        chart: {
            type: 'bar',
            height: 350,
            toolbar: {
                show: false,
            },
        },
        colors: ['#e74c3c'],
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
            categories: ['Total Demerit Point'],
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
    function updateBarChartData(totalDemeritCount) {
      console.log('Updating bar chart data with total demerit point count:', totalDemeritCount); // Debugging line
      barChart.updateSeries([{
        data: [totalDemeritCount] // Update with the total demerit point count
      }]);
    }

    // Call the function to update bar chart data with total demerit point count
    updateBarChartData(<?php echo $totalDemeritCount; ?>);



      // BAR CHART FOR TOTAL SUMMON
    const barChartOptions = {
      series: [
        {
          name: 'Total Summon',
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
        categories: ['Total Summon'],
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

  <?php
  //fetch summon count for student_ID through vehicle_numPlate from vehicle
    $summonQuery = "SELECT COUNT(*) AS summon_count 
                    FROM Summon s
                    JOIN Vehicle v ON s.vehicle_numPlate = v.vehicle_numPlate
                    JOIN Student st ON v.student_ID = st.student_ID
                    WHERE st.student_ID = ?";
    $stmtSummon = $con->prepare($summonQuery);
    $stmtSummon->bind_param("i", $studentID);
    $stmtSummon->execute();
    $summonResult = $stmtSummon->get_result();
    $summonData = $summonResult->fetch_assoc()['summon_count'];
    $stmtSummon->close();
    mysqli_close($con);
    ?>
    const summonData = [<?php echo $summonData; ?>];


    // Function to update bar chart data with total parking spaces count
    function updateBarChartData(totalSummonCount) {
      console.log('Updating bar chart data with total parking spaces count:', totalSummonCount); // Debugging line
      barChart.updateSeries([{
        data: [totalSummonCount] // Update with the total summon  count
      }]);
    }

    // Call the function to update bar chart data with total parking spaces count
    updateBarChartData(<?php echo $totalSummonCount; ?>);

  </script>

  <?php include '../Layout/allUserFooter.php'; ?>


</body>
</html>
