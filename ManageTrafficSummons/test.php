<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Minimal Example</title>
    <style>
        .container {
            display: block;
            width: 100%;
            padding: 20px 0;
        }
        .box1 h2 {
            float: left;
        }
        .box1 .button-container {
            float: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="box1">
            <h2>List of Parking</h2>
            <div class="button-container">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#parkingexampleModal">Add New Parking</button>
            </div>
        </div>
        <div id="list">
            <table class="table table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Area</th>
                        <th>Action</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Area 1</td>
                        <td>Action 1</td>
                        <td>Status 1</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
