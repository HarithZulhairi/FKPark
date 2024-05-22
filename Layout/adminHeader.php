<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>FKPark</title>

    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        header {
            background-color: black;
            color: white;
            padding: 10px 0;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .logo {
            font-size: 24px;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        nav ul li {
            position: relative;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
        }

        nav ul li a:hover {
            background-color: #575757;
        }

        .dropdown {
            display: none;
            position: absolute;
            background-color: #333;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown a {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown a:hover {
            background-color: #575757;
        }

        .profile a {
            color: white;
            text-decoration: none;
            padding: 10px;
            font-size: 20px;
            position: relative;
        }

        .profile-dropdown {
            display: none;
            position: absolute;
            background-color: #333;
            right: 0;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .profile-dropdown a {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .profile-dropdown a:hover {
            background-color: #575757;
        }

        main {
            flex: 1;
        }

        li a {
            font-size: 16px;
        }

        /* Modal styles */
        .modal1 {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            justify-content: center;
            align-items: center;
        }

        .modal-content1 {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #888;
            width: 300px;
            border-radius: 10px;
            text-align: center;
        }

        .modal1 .btn {
            margin: 5px;
            padding: 10px 20px;
        }

        .btn-cancel {
            background-color: #ccc;
        }

        .btn-cancel:hover {
            background-color: #999;
        }

    </style>
</head>
<body>

    <header>
        <div class="container">
            <div class="logo"><img src="../resource/FKPark1.jpeg" alt="FKPark" width="170" height="70"></div>
            <nav>
                <ul>
                    <li>
                        <a href="../LandingPage/LandingPage.php">Home</a>
                    </li>
                    <li>
                        <a class="dropdown-toggle-parking">Parking</a>
                        <div class="dropdown dropdown-parking">
                            <a href="../ManageParkingArea/viewParking.php">List</a>
                            <a href="../ManageParkingArea/ManageParking.php">Manage</a>
                        </div>
                    </li>
                    <li>
                        <a href="../Dashboard/adminDashboard.php" class="dropdown-toggle-dashboard">Dashboard</a>
                    </li>
                    <li>
                        <a href="../ManageRegistration/StudentRegistration.php">User Registration</a>
                    </li>
                </ul>
            </nav>
            <div class="profile">
                <a class="profile-toggle"><i class="fas fa-user"></i></a>
                <div class="profile-dropdown">
                    <a href="../Profile/AdminProfile.php">Profile</a>
                    <a href="#">Settings</a>
                    <a href="../Manage Login/Logout.php" id="logoutLink">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <!-- The Modal -->
    <div id="logoutModal" class="modal1">
        
        <div class="modal-content">
        <div class="modal-content1">
            <h2>Are you sure?</h2>
            <button id="proceedButton" class="btn btn-primary">Proceed</button>
            <button id="cancelButton" class="btn btn-cancel">Cancel</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var dropdowns = document.querySelectorAll('.dropdown');
            var dropdownToggles = document.querySelectorAll('.dropdown-toggle-parking, .dropdown-toggle-reports');
            var profileToggle = document.querySelector('.profile-toggle');

            function closeAllDropdowns() {
                dropdowns.forEach(function (dropdown) {
                    dropdown.style.display = 'none';
                });
            }

            dropdownToggles.forEach(function (toggle) {
                toggle.addEventListener('click', function (event) {
                    event.preventDefault();
                    closeAllDropdowns();
                    var dropdown = this.nextElementSibling;
                    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
                });
            });

            profileToggle.addEventListener('click', function (event) {
                event.preventDefault();
                closeAllDropdowns();
                var dropdown = this.nextElementSibling;
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
            });

            document.addEventListener('click', function (event) {
                if (!event.target.matches('.dropdown-toggle-parking, .dropdown-toggle-reports, .profile-toggle')) {
                    closeAllDropdowns();
                }
            });
        });

        document.getElementById('logoutLink').addEventListener('click', function(event) {
            event.preventDefault();  // Prevent the default link behavior
            document.getElementById('logoutModal').style.display = 'flex';  // Show the modal
        });

        document.getElementById('proceedButton').addEventListener('click', function() {
            window.location.href = '../Manage Login/Logout.php';  // Navigate to the logout page
        });

        document.getElementById('cancelButton').addEventListener('click', function() {
            document.getElementById('logoutModal').style.display = 'none';  // Hide the modal
        });

        // Close the modal if the user clicks outside of it
        window.onclick = function(event) {
            if (event.target == document.getElementById('logoutModal')) {
                document.getElementById('logoutModal').style.display = 'none';
            }
        }
    </script>

</body>
</html>
