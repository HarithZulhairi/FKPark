<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>FKPark</title>

    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif; /* Ensures the same font throughout */
        }

        body {
            display: flex;
            flex-direction: column;
        }

        header {
            background-color: #BE8A62;
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

        li a{
            font-size:16px;
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
                        <a href="#">Home</a>
                    </li>
                    <li>
                        <a href="../Manage Registration/RegistrationVehicle.php">Vehicle Registration</a>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle">Booking</a>
                        <div class="dropdown">
                            <a href="../ManageBooking/createBooking.php">Create Booking</a>
                            <a href="#">View Booking</a>
                        </div>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </nav>
            <div class="profile">
                <a href="#" class="profile-toggle"><i class="fas fa-user"></i></a>
                <div class="profile-dropdown">
                    <a href="#">Profile</a>
                    <a href="#">Settings</a>
                    <a href="#">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Booking dropdown toggle
            document.querySelector('.dropdown-toggle').addEventListener('click', function (event) {
                event.preventDefault();
                var dropdown = this.nextElementSibling;
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
            });

            // Profile dropdown toggle
            document.querySelector('.profile-toggle').addEventListener('click', function (event) {
                event.preventDefault();
                var dropdown = this.nextElementSibling;
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
            });

            // Close dropdowns if clicked outside
            document.addEventListener('click', function (event) {
                var isClickInsideBooking = document.querySelector('.dropdown-toggle').contains(event.target);
                var isClickInsideProfile = document.querySelector('.profile-toggle').contains(event.target);
                var dropdowns = document.querySelectorAll('.dropdown, .profile-dropdown');

                if (!isClickInsideBooking && !isClickInsideProfile) {
                    dropdowns.forEach(function (dropdown) {
                        dropdown.style.display = 'none';
                    });
                }
            });
        });

   

    </script>

</body>
</html>
