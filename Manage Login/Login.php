<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Login.css">
  <title>Login</title>
</head>
<body>
  
<div class="card">
  <div class="d-flex">
    <form id="loginForm">
      <div>
        <label for="username" class="form-label">Username</label>
        <input type="text" id="username" class="form-control" required />
      </div>
      <div>
        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" class="form-control" required />
      </div>
      <div>
        <select class="form-select form-control" id="userType" required>
          <option value="platinum">Undergraduate Student</option>
          <option value="staff">Postgraduate Student</option>
          <option value="mentor">Administrator</option>
          <option value="security">Unit Keselamatan Staff</option>
        </select>
      </div>
      <div class="d-flex">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="rememberMe" checked />
          <label class="form-check-label" for="rememberMe"> Remember me </label>
        </div>
        <div class="forgot-password">
            <a href="{{ route('forgot.password') }}" class="text-decoration-none">Forgot password?</a>
        </div>
      </div>
      <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('loginForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission

        // Get the form values
        var username = document.getElementById('username').value.trim();
        var password = document.getElementById('password').value.trim();
        var userType = document.getElementById('userType').value;

        // Perform validation
        if (username === '' || password === '') {
            alert('Please fill in all the fields.');
            return;
        }

        // Here, you can perform further validation or check against a database for correct credentials.
        // For demonstration purposes, let's assume correct credentials are 'admin' for both username and password.
        if (username !== 'admin' || password !== 'admin') {
            alert('Incorrect username or password. Please try again.');
            return;
        }

        // If everything is correct, you can proceed with the login action
        // For now, let's just log a success message
        alert('Login successful!');
    });
});
</script>

</body>
</html>
