<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="profile.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<style>


body {
    font-family: 'Roboto', sans-serif;
    background: linear-gradient(to right, #f5f7fa, #c3cfe2);
    display: flex;
    justify-content: center;
    height: 100vh;
    margin: 0;
}

.profile-container {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    padding: 20px;
}

.profile-card {
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    align-items: center;
    max-width: 500px;
    width: 100%;
    text-align: center;
    padding: 30px;
    position: relative;
}

.profile-image img {
    border-radius: 50%;
    width: 150px;
    height: 150px;
    object-fit: cover;
    border: none;
    margin-bottom: 25px;
    transition: transform 0.3s ease-in-out;
}

.profile-image img:hover {
    transform: scale(1.05);
}

.profile-info h2 {
    margin: 0;
    font-size: 2rem;
    color: #333;
    margin-bottom: 10px;
}

.profile-info p {
    font-size: 1.1rem;
    color: #777;
    margin: 10px 0;
    line-height: 1.6;
}

.profile-info p strong {
    color: #333;
}

.profile-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 10px;
    background: linear-gradient(to right, #4CAF50, #00BCD4);
}


</style>

<body>
    <?php include '../Layout/studentHeader.php'; ?>

    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-image">
                <img src="../resource/Harith.jpg" alt="User Image">
            </div>
            <div class="profile-info">
                <h2>//Name//</h2>
                <p><strong>Student ID:</strong> </p>
                <p><strong>Email:</strong>  </p>
                <p><strong>Age:</strong>    </p>
                <p><strong>Vehicle Type:</strong>   </p>
                <p><strong>Number Plate:</strong>   </p>
            </div>
        </div>
    </div>

    <?php include '../Layout/allUserFooter.php'; ?>
</body>
</html>
