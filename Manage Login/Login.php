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
    <form>
      <div>
        <label for="form2Example1" class="form-label">Username</label>
        <input type="email" id="form2Example1" class="form-control" />
      </div>
      <div>
        <label for="form2Example2" class="form-label">Password</label>
        <input type="password" id="form2Example2" class="form-control" />
      </div>
      <div>
        <select class="form-select form-control" id="userType">
          <option value="platinum">Undergraduate Student</option>
          <option value="staff">Postgraduate Student</option>
          <option value="mentor">Administrator</option>
		  <option value="mentor">Unit Keselamatan Staff</option>

        </select>
      </div>
      <div class="d-flex">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
          <label class="form-check-label" for="form2Example31"> Remember me </label>
        </div>
        <div class="forgot-password">
          <a href="{{ route('forgot.password') }}" class="text-decoration-none">Forgot password?</a>
        </div>
      </div>
      <button type="button" class="btn btn-primary btn-block">Login</button>
    </form>
  </div>
</div>

</body>
</html>