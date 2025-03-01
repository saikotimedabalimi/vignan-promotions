<?php
// Fetching all the Functions and DB Code
require('../includes/functions.inc.php');
require('../includes/database.inc.php');
session_start();

// Checking if the Admin is logged in already
if (isset($_SESSION['ADMIN_LOGGED_IN']) && $_SESSION['ADMIN_LOGGED_IN'] == "YES") {
    // Redirect to the admin dashboard if already logged in
    redirect('./index.php');
}

// Whenever login button is pressed
if (isset($_POST['login-submit'])) {
    // Fetching values via POST and sanitizing inputs
    $loginEmail = get_safe_value($_POST['login-email']);
    $loginPassword = get_safe_value($_POST['login-password']);
    
    // Query to check if the email exists
    $loginQuery = "SELECT * FROM admin WHERE admin_email = '{$loginEmail}'";
    $result = mysqli_query($con, $loginQuery);
    $rows = mysqli_num_rows($result);

    if ($rows > 0) {
        // Fetching user data
        $data = mysqli_fetch_assoc($result);

        // Verifying password
        if (password_verify($loginPassword, $data['admin_password'])) {
            // Setting session variables for admin
            $_SESSION['ADMIN_LOGGED_IN'] = "YES";
            $_SESSION['ADMIN_ID'] = $data['admin_id'];

            // Clearing other user session variables
            unset($_SESSION['USER_NAME'], $_SESSION['USER_LOGGED_IN'], $_SESSION['USER_ID'], $_SESSION['USER_EMAIL']);
            unset($_SESSION['AUTHOR_NAME'], $_SESSION['AUTHOR_LOGGED_IN'], $_SESSION['AUTHOR_ID'], $_SESSION['AUTHOR_EMAIL']);

            // Redirect to the admin dashboard
            redirect('./index.php');
        } else {
            // Incorrect password
            $_SESSION['error'] = "Incorrect Password.";
            redirect('./login.php');
        }
    } else {
        // Email not found
        $_SESSION['error'] = "Invalid Email Address.";
        redirect('./login.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Vignan Admin Panel | Login</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon" />
    <link href="../assets/css/admin/style.css" rel="stylesheet" />
    <link href="../assets/css/partials/1-variables.css" rel="stylesheet" />

    <style>
        body {
    background: url('../assets/images/background.jpg') no-repeat center center fixed;
    background-size: cover;
    position: relative;
}

body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* Dark overlay for better text visibility */
}

.login-main {
    position: relative;
    z-index: 10;
}

        .well {
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            background: #ffffff;
        }
        .btn-danger {
            background: linear-gradient(90deg, #ff512f, #dd2476);
            transition: 0.3s;
        }
        .btn-danger:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(255, 81, 47, 0.4);
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 4px 6px rgba(0, 123, 255, 0.3);
        }
    </style>
</head>

<body>
    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">Vignan <small>Admin Login</small></h1>
                </div>
            </div>
        </div>
    </header>

    <section id="main" class="login-main">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form id="login" method="POST" class="well">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" class="form-control" placeholder="Enter Email" name="login-email" required />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="login-password" required />
                        </div>
                        <button type="submit" class="btn btn-danger btn-block" name="login-submit">
                            Login
                        </button>
                        <p class="text-center mt-3">
                            <a href="./forgot-password.php">Forgot Password?</a>
                        </p>
                    </form>

                    <!-- Display error message if session error is set -->
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger text-center mt-3">
                            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <?php require('./includes/footer.inc.php'); ?>
</body>
</html>
