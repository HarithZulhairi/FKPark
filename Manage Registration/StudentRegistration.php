<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="StudentRegistration.css">
    <title>Student Registration</title>
</head>
<body>
    <?php include '../Layout/adminHeader.php'; ?>
    
    <main>
        <div class="container-registration">
            <h2 class="title-registration">Student Registration</h2>
            <form class="form-card">
                <table class="form-table">
                    <tr>
                        <td><label for="name">Username</label></td>
                        <td><input type="text" id="name" name="Name" class="form-control" placeholder="Enter student username"></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password</label></td>
                        <td><input type="password" id="password" name="Password" class="form-control" placeholder="Enter student password"></td>
                    </tr>
                    <tr>
                        <td><label for="email">Email</label></td>
                        <td><input type="email" id="email" name="Email" class="form-control" placeholder="Enter student email"></td>
                    </tr>
                    <tr>
                        <td><label for="age">Age</label></td>
                        <td><input type="number" id="age" name="Age" class="form-control" placeholder="Enter student age"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><button type="submit" class="btn btn-primary">Submit</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </main>

    <?php include '../Layout/allUserFooter.php'; ?>
</body>
</html>
