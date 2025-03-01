<?php
  // Fetching all the Navbar Data
  require('./includes/nav.inc.php');

  // Checking if the User is logged in already
  if(isset($_SESSION['USER_LOGGED_IN']) && $_SESSION['USER_LOGGED_IN'] == "YES") {
    // Redirected to home page
    redirect('./index.php');
  }

  // Whenever login button is pressed
  if(isset($_POST['login-submit'])) {
    $loginRegistrationNumber = get_safe_value($_POST['login-registration-number']);
    $loginPassword = get_safe_value($_POST['login-password']);
    
    $loginQuery = "SELECT * FROM user WHERE user_registration_number = '{$loginRegistrationNumber}'";
    $result = mysqli_query($con, $loginQuery);
    $rows = mysqli_num_rows($result);

    if($rows > 0) {
        while($data = mysqli_fetch_assoc($result)) {
            $password_check = password_verify($loginPassword, $data['user_password']);
            if($password_check) {
                $_SESSION['USER_NAME'] = $data['user_name'];
                $_SESSION['USER_LOGGED_IN'] = "YES";
                $_SESSION['USER_ID'] = $data['user_id'];
                $_SESSION['USER_EMAIL'] = $data['user_email'];

                unset($_SESSION['AUTHOR_NAME']);
                unset($_SESSION['AUTHOR_LOGGED_IN']);
                unset($_SESSION['AUTHOR_ID']);
                unset($_SESSION['AUTHOR_EMAIL']);

                redirect('./index.php');
            } else {
                alert("Wrong Password");
                redirect('./user-login.php');
            }
        }     
    } else {
        alert("This Registration Number is not registered. Please Register");
        redirect('./user-login.php');
    }
  }

  // Whenever signup button is pressed
  if(isset($_POST['signup-submit'])) {
    $signupName = get_safe_value($_POST['signup-name']);
    $signupEmail = get_safe_value($_POST['signup-email']);
    $signupPassword = get_safe_value($_POST['signup-password']);
    $signupRegistrationNumber = get_safe_value($_POST['signup-registration-number']);

    $strg_pass = password_hash($signupPassword, PASSWORD_BCRYPT);
    
    $check_sql = "SELECT user_email FROM user WHERE user_email = '{$signupEmail}'";
    $check_result = mysqli_query($con, $check_sql);
    $check_row = mysqli_num_rows($check_result);
    
    if($check_row > 0) {
      alert("Email Already Exists");
      redirect('./user-login.php');
    } else {
      $signupQuery = "INSERT INTO user (user_name, user_email, user_password, user_registration_number) 
                      VALUES ('{$signupName}', '{$signupEmail}', '{$strg_pass}', '{$signupRegistrationNumber}')";
      $result = mysqli_query($con, $signupQuery);

      if($result) {
        alert("Signup Successful, Please Login");
        redirect('./user-login.php');
      } else {
        echo "Error: ".mysqli_error($con);
      }
    }
  }
?>

<!-- Container for Forms -->
<div class="container p-2">
  <div class="forms-container">
    <!-- Tab Navigation -->
    <div class="form-tabs">
      <button class="tab-btn active" onclick="showLogin()">Login</button>
      <button class="tab-btn" onclick="showSignup()">Signup</button>
    </div>

    <!-- Wrapper for Forms -->
    <div class="form-wrapper">
      <!-- Left div for Login -->
      <div class="left form-slide active">
        <div class="form-title">
          <h4>User Login</h4>
        </div>
        <div class="login-form-container">
          <form method="POST" class="login-form" id="login-form">
            <div class="input-field">
              <input type="text" name="login-registration-number" id="login-registration-number" placeholder="Registration Number" autocomplete="off" required>
            </div>
            <div class="input-field">
              <input type="password" name="login-password" id="login-password" placeholder="Password" autocomplete="off" required>
            </div>
            <div class="input-field">
              <button type="submit" name="login-submit">Login</button>
            </div>
            <div class="input-field">
              <a href="./user forgot.php">Forgot Password?</a>
            </div>
          </form>
        </div>
      </div>

      <!-- Right div for Signup -->
      <div class="right form-slide">
        <div class="form-title">
          <h4>User Signup</h4>
        </div>
        <div class="signup-form-container">
          <form method="POST" class="signup-form" id="signup-form">
            <div class="input-field">
              <input type="text" name="signup-name" id="signup-name" placeholder="Name" autocomplete="off" required>
            </div>
            <div class="input-field">
              <input type="email" name="signup-email" id="signup-email" placeholder="Email Address" autocomplete="off" required>
            </div>
            <div class="input-field">
              <input type="password" name="signup-password" id="signup-password" placeholder="Password" autocomplete="off" required>
            </div>
            <div class="input-field">
              <input type="text" name="signup-registration-number" id="signup-registration-number" placeholder="Registration Number" autocomplete="off" required>
            </div>
            <div class="input-field">
              <input type="password" name="signup-confirm-password" id="signup-confirm-password" placeholder="Confirm Password" autocomplete="off" required>
            </div>
            <div class="input-field">
              <button type="submit" name="signup-submit">Signup</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Script for Form Animation -->
<script>
  function showLogin() {
    document.querySelector('.left').classList.add('active');
    document.querySelector('.right').classList.remove('active');
    document.querySelector('.tab-btn:nth-child(1)').classList.add('active');
    document.querySelector('.tab-btn:nth-child(2)').classList.remove('active');

    document.querySelector('.left').classList.add('bounce-effect');
    setTimeout(() => document.querySelector('.left').classList.remove('bounce-effect'), 500);
  }

  function showSignup() {
    document.querySelector('.right').classList.add('active');
    document.querySelector('.left').classList.remove('active');
    document.querySelector('.tab-btn:nth-child(2)').classList.add('active');
    document.querySelector('.tab-btn:nth-child(1)').classList.remove('active');

    document.querySelector('.right').classList.add('bounce-effect');
    setTimeout(() => document.querySelector('.right').classList.remove('bounce-effect'), 500);
  }
</script>

<!-- Styles for Enhanced Realistic Animation -->
<style>
  .forms-container {
    text-align: center;
  }

  .form-tabs {
    display: flex;
    justify-content: center;
    margin-bottom: 15px;
  }

  .tab-btn {
    padding: 12px 24px;
    border: none;
    cursor: pointer;
    background: linear-gradient(90deg, #007bff, #0056b3);
    color: white;
    margin: 0 5px;
    font-size: 16px;
    border-radius: 8px;
    transition: 0.4s ease-in-out;
    box-shadow: 0 4px 6px rgba(0, 123, 255, 0.3);
  }

  .tab-btn:hover {
    background: linear-gradient(90deg, #0056b3, #007bff);
    transform: scale(1.05);
  }

  .tab-btn.active {
    background: linear-gradient(90deg, #ff512f, #dd2476);
    box-shadow: 0 6px 12px rgba(255, 81, 47, 0.4);
    transform: scale(1.1);
  }

  .form-wrapper {
    position: relative;
    width: 400px;
    height: 600px;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    background: #ffffff;
  }

  .form-slide {
    position: absolute;
    width: 100%;
    padding: 20px;
    transition: transform 0.8s cubic-bezier(0.25, 1, 0.5, 1), opacity 0.5s ease-in-out;
    opacity: 0;
    filter: blur(4px);
  }

  .left {
    transform: translateX(0%);
    opacity: 1;
    filter: blur(0px);
  }

  .right {
    transform: translateX(100%);
  }

  .form-slide.active {
    transform: translateX(0%);
    opacity: 1;
    filter: blur(0px);
  }

  /* Bounce Effect */
  .bounce-effect {
    animation: bounce 0.4s ease-in-out;
  }

  @keyframes bounce {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
  }

  /* Input Fields */
  .input-field {
    margin: 10px 0;
  }

  .input-field input {
    width: 100%;
    padding: 12px;
    border: 2px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    transition: 0.3s ease-in-out;
  }

  .input-field input:focus {
    border-color: #007bff;
    box-shadow: 0 4px 6px rgba(0, 123, 255, 0.3);
    transform: scale(1.02);
  }

  .input-field button {
    width: 100%;
    padding: 12px;
    border: none;
    background: linear-gradient(90deg, #ff512f, #dd2476);
    color: white;
    font-size: 16px;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s ease-in-out;
  }

  .input-field button:hover {
    background: linear-gradient(90deg, #dd2476, #ff512f);
    transform: scale(1.05);
    box-shadow: 0 6px 12px rgba(255, 81, 47, 0.4);
  }
</style>

<!-- Script for form validation -->
<script src="./assets/js/form-validate.js"></script>

<?php
  require('./includes/footer.inc.php');
?>