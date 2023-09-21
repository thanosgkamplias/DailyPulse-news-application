<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="resorce/css/style.css" rel="stylesheet">

    <title>Employee Management System</title>
    <style>
    body, html {
    height: 100%;
    margin: 0;
    }

.bg {
  background-image: url("../background.jpg");
  height: 100%;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
</style>
  </head>
  <body>

  <!-- PHP script section -->
  <?php
  session_start();

  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  $email_err = $pass_err = $login_Err = "";
  $email = $pass = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["email"])) {
          $email_err = "<p style='color:red'> * Email Can Not Be Empty</p>";
      } else {
        $email = trim($_POST["email"]);
      }

      if (empty($_POST["password"])) {
          $pass_err = "<p style='color:red'> * Password Can Not Be Empty</p>";
      } else {
          $pass = $_POST["password"];
      }

      if (!empty($email) && !empty($pass)) {
          // Include database connection
          require_once "include/connection.php";

          // Use prepared statement to retrieve the hashed password
          $stmt = $conn->prepare("SELECT email, password FROM journalist WHERE email = '$email'");
          $stmt->execute();
          $stmt->bind_result($email, $hashed_password);
          $stmt->fetch();
          $stmt->close();

          if (password_verify($pass, $hashed_password)) {
              $_SESSION["email"] = $email;
              header("Location: index.php?login-success");
              exit;
          } else {
            echo "Email from Database: " . $email . "<br>";
            echo "Hashed Password from Database: " . $hashed_password . "<br>";
            echo "Hashed Password from User Input: " . password_hash($pass, PASSWORD_DEFAULT) . "<br>";

              $login_Err = "<div class='alert alert-warning alert-dismissible fade show'>
                  <strong>Invalid Email/Password</strong>
                  <button type='button' class='close' data-dismiss='alert'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>";
          }

          $conn->close();
      }
  }
  ?>
 <!-- End of PHP script section -->


<div class="bg">
  <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                  <div class="text-center mt-3">
                    <a href="../index.php" class="btn btn-primary">
                        <i class="fa fa-home fa-lg" style="color: #ffffff;"></i>
                    </a>
                  </div>
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5 shadow">

                                    <h4 class="text-center">Hello, Journalist</h4>
                                    <div class="text-center my-5"> <?php echo $login_Err; ?> </div>

                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">

                                    <div class="form-group">
                                        <label >Email :</label>
                                        <input type="email" class="form-control" value="<?php echo $email; ?>" name="email">
                                        <?php echo $email_err; ?>
                                    </div>

                                    <div class="form-group">
                                        <label >Password :</label>
                                        <input type="password" class="form-control" name="password" >
                                        <?php echo $pass_err; ?>

                                    </div>

                                    <div class="form-group">
                                        <input type="submit" value="Log-In" class="btn btn-primary btn-lg w-100 " name="signin" >
                                    </div>
                                    <div class="login-link">Are you a Curator? <a href="../admin/login.php">Log in here</a></div>
                                    <div class="signup-link">Are you a new Journalist? <a href="signup.php">Sign up in here</a></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="resorce/plugins/common/common.min.js"></script>
    <script src="resorce/js/custom.min.js"></script>
    <script src="resorce/js/settings.js"></script>
    <script src="resorce/js/gleek.js"></script>
    <script src="resorce/js/styleSwitcher.js"></script>
  </body>
</html>
