<?php
require('./includes/nav.inc.php');

if (isset($_POST['reset-submit'])) {
    $email = get_safe_value($_POST['email']);
    
    // Check if the email exists in the database
    $query = "SELECT * FROM user WHERE user_email = '{$email}'";
    $result = mysqli_query($con, $query);
    
    if (mysqli_num_rows($result) > 0) {
        // Generate a unique token
        $token = bin2hex(random_bytes(50));
        
        // Store the token in the database with an expiration time
        $expiry = date("Y-m-d H:i:s", strtotime('+1 hour'));
        $updateQuery = "UPDATE user SET reset_token = '{$token}', token_expiry = '{$expiry}' WHERE user_email = '{$email}'";
        mysqli_query($con, $updateQuery);
        
        // Send the email with the reset link
        $resetLink = "http://yourdomain.com/reset-password.php?token={$token}";
        mail($email, "Password Reset Request", "Click this link to reset your password: {$resetLink}");
        
        alert("A password reset link has been sent to your email.");
        redirect('./user-login.php');
    } else {
        alert("Email not found.");
    }
}
?>

<!-- HTML Form for Forgot Password -->
<div class="container">
    <h2>Forgot Password</h2>
    <form method="POST">
        <div class="input-field">
            <input type="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="input-field">
            <button type="submit" name="reset-submit">Send Reset Link</button>
        </div>
    </form>
</div>