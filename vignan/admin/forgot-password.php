<?php
require('../includes/functions.inc.php');
require('../includes/database.inc.php');
session_start();

if (isset($_POST['forgot-password-submit'])) {
  $email = get_safe_value($_POST['email']);

  // Check if email exists
  $query = "SELECT * FROM admin WHERE admin_email = '{$email}'";
  $result = mysqli_query($con, $query);

  if (mysqli_num_rows($result) > 0) {
    // Generate reset token
    $token = bin2hex(random_bytes(32));
    $expires = date("Y-m-d H:i:s", strtotime('+1 hour'));

    // Save token in the database
    $updateQuery = "UPDATE admin SET reset_token = '{$token}', reset_expires = '{$expires}' WHERE admin_email = '{$email}'";
    mysqli_query($con, $updateQuery);

    // Send reset email
    $resetLink = "http://yourwebsite.com/reset-password.php?token={$token}";
    $subject = "Password Reset Request";
    $message = "Click the link below to reset your password: \n\n{$resetLink}";
    mail($email, $subject, $message, "From: no-reply@yourwebsite.com");

    $_SESSION['success'] = "Password reset link has been sent to your email.";
    redirect('./forgot-password.php');
  } else {
    $_SESSION['error'] = "No account found with this email.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Forgot Password</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <h2 class="text-center">Forgot Password</h2>
        <?php if (isset($_SESSION['error'])): ?>
          <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])): ?>
          <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>
        <form method="POST">
          <div class="form-group">
            <label>Email Address</label>
            <input type="email" class="form-control" name="email" placeholder="Enter your registered email" required />
          </div>
          <button type="submit" name="forgot-password-submit" class="btn btn-primary">Send Reset Link</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
