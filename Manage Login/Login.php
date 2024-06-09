<?php
    session_start();

    $con = mysqli_connect("localhost", "root", "");
    if (!$con) {
        die('Could not connect: ' . mysqli_connect_error());
    }

    mysqli_select_db($con, "fkpark") or die(mysqli_error($con));

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $role = $_POST['role'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Check the role and select the corresponding table
        switch ($role) {
            case 'Student':
                $table = 'Student';
                $userColumn = 'student_username';
                $passColumn = 'student_password';
                $idColumn = 'student_ID';
                $homePage = '../Home/studentHomePage.php';
                break;
            case 'Administrator':
                $table = 'Administrator';
                $userColumn = 'administrator_username';
                $passColumn = 'administrator_password';
                $idColumn = 'administrator_ID';
                $homePage = '../Home/adminHomePage.php';
                break;
            case 'UnitKeselamatanStaff':
                $table = 'UnitKeselamatanStaff';
                $userColumn = 'uk_username';
                $passColumn = 'uk_password';
                $idColumn = 'uk_ID';
                $homePage = '../Home/ukHomePage.php';
                break;
            default:
                $error = "Invalid role selected.";
                break;
        }

        if (!isset($error)) {
            $stmt = $con->prepare("SELECT $idColumn FROM $table WHERE $userColumn = ? AND $passColumn = ?");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows == 1) {
                // Fetch user ID
                $row = $result->fetch_assoc();
                $userID = $row[$idColumn];

                // Store role, username, and user ID in session
                $_SESSION['role'] = $role;
                $_SESSION['username'] = $username;
                $_SESSION['userID'] = $userID;

                // Set cookies to remember the user for 7 days
                setcookie('role', $role, time() + (86400 * 7), "/");
                setcookie('username', $username, time() + (86400 * 7), "/");
                setcookie('userID', $userID, time() + (86400 * 7), "/");

                header("Location: $homePage");
                exit;
            } else {
                $error = "Invalid username or password.";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="Login.php">
        <label for="role">Role:</label>
        <select name="role" id="role" required>
            <option value="Student">Student</option>
            <option value="Administrator">Administrator</option>
            <option value="UnitKeselamatanStaff">Unit Keselamatan Staff</option>
        </select>
        <br><br>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <button type="submit">Login</button>
    </form>
    <?php
    if (isset($error)) {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>
    <p><a href="forgotPassword.php">Forgot Password?</a></p>
</body>
</html>
