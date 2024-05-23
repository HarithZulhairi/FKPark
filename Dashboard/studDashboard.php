<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="studDashboard.css">
    <title>User Dashboard</title>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
</head>
<body>
    <?php include '../Layout/studentHeader.php'; ?>

    <div class="header">
        <h1>User Dashboard</h1>
    </div>
    <div class="content">
        <div class="card">
            <h2>Registration Status</h2>
            <p>Active</p>
        </div>
        <div class="card">
            <h2>Total Demerit Points</h2>
            <p>5</p>
        </div>
    </div>

    <?php include '../Layout/allUserFooter.php'; ?>
</body>
</html>
