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
    <div class="alert">
    <?php
session_start();
if (isset($_SESSION['message'])) {
    echo '<div class="alert">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
}
?>
    </div>
    <form method="POST" action="FinancialApp/loginUser">
      <h2>Login</h2>
        <div class="input-field">
        <input type="text" name="email" required>
        <label>Enter your email</label>
      </div>
      <div class="input-field">
        <input type="password" name="password" required>
        <label>Enter your password</label>
      </div>
      <div class="forget">
        <!-- <label for="remember">
          <input type="checkbox" id="remember">
          <p>Remember me</p>
        </label> -->
        <!-- <a href="#">Forgot password?</a> -->
      </div>
      <button type="submit">Submit</button>
      <div class="register">
        <p>Don't have an account? <a href="register">Register</a></p>
      </div>
    </form>
  </div>
</body>
</html>

<style>
  .alert {
    color: red;
    font-size: 18px;
    font-weight: bold;
  }
</style>