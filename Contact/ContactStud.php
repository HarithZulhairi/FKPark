<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            height: 100vh;
        }
        .container {
            width: 80%;
            max-width: 1200px;
            margin: 0 auto;
            border-radius: 10px;
            overflow: hidden;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 20px;
            text-align: center;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        td {
            background-color: #f4f4f9;
        }
        img {
            border-radius: 50%;
            border: 2px solid #007BFF;
        }
        @media (max-width: 600px) {
            table, th, td {
                display: block;
                width: 100%;
            }
            th, td {
                padding: 10px;
                text-align: center;
            }
            img {
                width: 80px;
                height: 80px;
            }
        }
    </style>
</head>
<body>
<?php include '../Layout/studentHeader.php'; ?>

    <div class="container">
        <table>
            <tr>
                <th><img src="cipud.png" alt="akmal" width="100" height="100"></th>
                <th><img src="arep.png" alt="arif" width="100" height="100"></th>
                <th><img src="whoopy.png" alt="harith" width="100" height="100"></th>
                <th><img src="azam.png" alt="Azam" width="100" height="100"></th>
            </tr>
            <tr>
                <td>CB22071</td>
                <td>CB22085</td>
                <td>CB22028</td>
                <td>CB22129</td>
            </tr>
        </table>
    </div>

    <?php include '../Layout/allUserFooter.php'; ?>

</body>
</html>
