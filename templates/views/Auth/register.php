<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link rel="stylesheet" type="text/css" href="assets/auth.css" />
</head>
<body>
  <div class="wrapper">
  <form method="POST" action="FinancialApp/registerUser">
      <h2>Register</h2>
        <div class="input-field">
        <input type="text" name="name" required>
        <label>Enter your name</label>
      </div>
	  <div class="input-field">
        <input type="email" name="email" required>
        <label>Enter your email</label>
      </div>
      <div class="input-field">
        <input type="password" name="password" required>
        <label>Enter your password</label>
      </div>
	  <div class="input-field">
        <input type="password" name="c_password" required>
        <label>Enter your confirm password</label>
      </div>
      <button type="submit">Submit</button>
      <div class="register">
        <p>Have an account? &nbsp<a href="login">Login</a></p>
      </div>
    </form>
  </div>
</body>
</html>