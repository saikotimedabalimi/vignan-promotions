<?php
require('./includes/nav.inc.php');

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    
    // Check if the token is valid
    $query = "SELECT * FROM author WHERE reset_token = '{$token}' AND token_expiry > NOW()";
    $result = mysqli_query($con, $query);
    
    if (mysqli_num_rows($result) == 0) {
        alert("Invalid or expired token.");
        redirect('./author-login.php');
    }
    
    if (isset($_POST['update-password'])) {
        $newPassword = get_safe_value($_POST['new-password']);
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        
        // Update the password and clear the token
        $updateQuery = "UPDATE author SET author_password = '{$hashedPassword}', reset_token = NULL, token_expiry = NULL WHERE reset_token = '{$token}'";
        mysqli_query($con, $updateQuery);
        
        alert("Password has been updated successfully.");
        redirect('./author-login.php');
    }
}
?>

<!-- HTML Form for Resetting Password -->
<div class="container">
    <h2>Reset Password</h2>
    <form method="POST">
        <div class="input-field">
            <input type="password" name="new-password" placeholder="New Password" required>
        </div>
        <div class="input-field">
            <button type="submit" name="update-password">Update Password</button>
        </div>
    </form>
</div>