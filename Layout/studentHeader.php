<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
            background-color: #333;
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

        .profile a {
            color: white;
            text-decoration: none;
            padding: 10px;
            font-size: 20px;
        }

        .profile a:hover {
            color: #ccc;
        }

        main {
            flex: 1;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo"><b>FK</b>Park</div>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Booking</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>
            <div class="profile">
                <a href="#"><i class="fas fa-user"></i></a>
            </div>
        </div>
    </header>

</body>
</html>
