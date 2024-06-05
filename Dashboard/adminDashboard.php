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
                    <p class="text-primary">TOTAL PARKING SLOT</p>
                    <span ><img class="colored_image" style="width:50px; height:50px;" src="../resource/book_online.png" alt="Parking"></span>
                </div>
                <!-- Update the total parking spaces count with PHP -->
                <span class="text-primary font-weight-bold">
                    <?php
                    include '../DB_FKPark/dbcon.php'; // Include dbcon.php to establish database connection

<<<<<<< Updated upstream
                        // Connect to Database
                        $con = mysqli_connect("localhost", "root", "");
                        if (!$con) {
                            die('Could not connect: ' . mysqli_connect_error());
                        }
                        
                        mysqli_select_db($con, "fkpark") or die(mysqli_error($con));

                        // Fetch count of parking spaces from the database
                        $query1 = "SELECT COUNT(*) AS total_booking FROM parkingArea";
                        $result1 = mysqli_query($con, $query1);

                        // Initialize a variable to store the count of parking spaces
                        $totalSpacesCount = 0;

                        // Check if the query was successful and fetch the count
                        if ($result1 && mysqli_num_rows($result1) > 0) {
                            $row1 = mysqli_fetch_assoc($result1);
                            $totalSpacesCount = (int)$row1['total_booking'];
                        }

                        $query2 = "SELECT COUNT(*) AS total_parking FROM parkingSlot";
                        $result2 = mysqli_query($con, $query2);

                        $totalParkingCount = 0;

                        if ($result2 && mysqli_num_rows($result2) > 0){
                            $row2 = mysqli_fetch_assoc($result2);
                            $totalParkingCount = (int)$row2['total_parking'];
                        }

                        echo $totalSpacesCount;
                      ?>
                  </span>
              </div>
=======
                    // Fetch count of parking spaces from the database
 
                    $query = "SELECT COUNT(*) AS total_parking FROM parkingSlot";
                    $result = mysqli_query($con, $query);

                    // Initialize a variable to store the count of parking spaces
                    $totalSpacesCount = 0;

                    // Check if the query was successful and fetch the count
                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $totalSpacesCount = (int)$row['total_parking'];
                    }

                    echo $totalSpacesCount; // Output the total parking spaces count
                    ?>
                </span>
            </div>

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">TOTAL EVENT </p>
                    <span><img class="colored_image" style="width:50px; height:50px;" src="../resource/unavailable.png" alt="Occupied"></span>
                </div>
                 <!-- Update the total parking spaces count with PHP -->
                 <span class="text-primary font-weight-bold">
                    <?php

                    // Fetch count of parking spaces from the database
                    $query = "SELECT COUNT(*) AS total_event FROM event";
                    $result = mysqli_query($con, $query);

                    // Initialize a variable to store the count of parking spaces
                    $totalEvent = 0;

                    // Check if the query was successful and fetch the count
                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $totalEvent = (int)$row['total_event'];
                    }
>>>>>>> Stashed changes

                    echo $totalEvent; // Output the total parking spaces count
                    ?>
                </span>
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
      categories: ['B1'],
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

<<<<<<< Updated upstream
      // AREA CHART OPTIONS
      const areaChartOptions = {
          series: [
              {
                  name: 'Car',
                  data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
              },
              {
                  name: 'Motorcycle',
                  data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
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
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          markers: {
              size: 0,
          },
          yaxis: [
              {
                  title: {
                      text: 'Number of Booking',
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

      <?php
          // Fetch car and motorcycle bookings for each month
          $carBookingsQuery = "SELECT COUNT(*) AS car_bookings, 
                                MONTH(booking_date) AS month 
                                FROM booking 
                                INNER JOIN parkingSlot ON booking.parkingSlot_ID = parkingSlot.parkingSlot_ID
                                WHERE parkingSlot.parkingSlot_name LIKE 'B1%' OR parkingSlot.parkingSlot_name LIKE 'B2%' OR parkingSlot.parkingSlot_name LIKE 'B3%'
                                GROUP BY MONTH(booking_date)
                                ";

          $motorcycleBookingsQuery = "SELECT COUNT(*) AS motorcycle_bookings, 
                                    MONTH(booking_date) AS month 
                                    FROM booking 
                                    INNER JOIN parkingSlot ON booking.parkingSlot_ID = parkingSlot.parkingSlot_ID
                                    WHERE parkingSlot.parkingSlot_name LIKE 'M1%'
                                    GROUP BY MONTH(booking_date)
                                    ";

          $carBookingsResult = mysqli_query($con, $carBookingsQuery);
          $motorcycleBookingsResult = mysqli_query($con, $motorcycleBookingsQuery);

          // Initialize arrays to store data
          $carBookingsData = array_fill(0, 12, 0);
          $motorcycleBookingsData = array_fill(0, 12, 0);

          while($row = mysqli_fetch_assoc($carBookingsResult)) {
              $monthIndex = intval($row['month']) - 1;
              $carBookingsData[$monthIndex] = intval($row['car_bookings']);
          }

          while($row = mysqli_fetch_assoc($motorcycleBookingsResult)) {
              $monthIndex = intval($row['month']) - 1;
              $motorcycleBookingsData[$monthIndex] = intval($row['motorcycle_bookings']);
          }
      ?>

      // Function to update area chart data
      function updateAreaChartData(carBookingsQuery, motorcycleBookingsQuery) {
          console.log('Updating area chart data to:', carBookingsQuery, motorcycleBookingsQuery); // Debugging line
          areaChart.updateSeries([
              { data: carBookingsQuery },
              { data: motorcycleBookingsQuery }
          ]);
      }

      // Example of updating area chart data
      updateAreaChartData(<?php echo json_encode($carBookingsData); ?>, <?php echo json_encode($motorcycleBookingsData); ?>);


  </script>

  <?php include '../Layout/allUserFooter.php'; ?>
=======
<?php include '../Layout/allUserFooter.php'; ?>
>>>>>>> Stashed changes


</body>
</html>
