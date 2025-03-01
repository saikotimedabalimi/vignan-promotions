<?php
require('../includes/functions.inc.php');
require('../includes/database.inc.php');
session_start();

if (isset($_GET['token'])) {
  $token = $_GET['token'];

  // Validate token
  $query = "SELECT * FROM admin WHERE reset_token = '{$token}' AND reset_expires > NOW()";
  $result = mysqli_query($con, $query);

  if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);

    if (isset($_POST['reset-password-submit'])) {
      $newPassword = password_hash(get_safe_value($_POST['new-password']), PASSWORD_BCRYPT);

      // Update password and clear the reset token
      $updateQuery = "UPDATE admin SET admin_password = '{$newPassword}', reset_token = NULL, reset_expires = NULL WHERE reset_token = '{$token}'";
      mysqli_query($con, $updateQuery);

      $_SESSION['success'] = "Password reset successfully. You can now log in.";
      redirect('./login.php');
    }
  } else {
    $_SESSION['error'] = "Invalid or expired reset link.";
    redirect('./forgot-password.php');
  }
} else {
  $_SESSION['error'] = "No reset token provided.";
  redirect('./login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Reset Password</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <h2 class="text-center">Reset Password</h2>
        <?php if (isset($_SESSION['error'])): ?>
          <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        <form method="POST">
          <div class="form-group">
            <label>New Password</label>
            <input type="password" class="form-control" name="new-password" placeholder="Enter new password" required />
          </div>
          <button type="submit" name="reset-password-submit" class="btn btn-success">Reset Password</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
