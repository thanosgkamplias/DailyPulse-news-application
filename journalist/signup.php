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
<!-- PHP script start -->
<?php
$name = $email = $gender = $password = "";

// Επεξεργασία των δεδομένων της φόρμας
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $gender = $_POST["gender"];

    // Θα πρέπει να προσθέσετε περισσότερους ελέγχους ασφαλείας εδώ.

    // Παράδειγμα: κρυπτογραφούμε τον κωδικό πρόσβασης (θα πρέπει να χρησιμοποιήσετε μια πιο ασφαλή μέθοδο)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    require_once "include/connection.php";

    // Εισαγωγή των δεδομένων του χρήστη στη βάση δεδομένων
    $sql_query = "INSERT INTO journalist (name, email, password, gender) VALUES ('$name', '$email', '$hashedPassword', '$gender')";
    $result = mysqli_query($conn, $sql_query);

    if ($result === false) {
        echo "Error: " . mysqli_error($conn);
    } else {
        // Έλεγξη εάν το ερώτημα εκτελέστηκε με επιτυχία
        if (mysqli_affected_rows($conn) > 0) {
            session_start();
            $_SESSION["email"] = $email;
            header("Location: login.php?signup-success");
            exit(); // Βεβαιωθείτε ότι δεν θα εκτελεστεί άλλος κώδικας
        } else {
            echo "Η εγγραφή απέτυχε. Δεν εισήχθησαν γραμμές.";
        }
    }

    // Κλείσιμο της δήλωσης και της σύνδεσης
    $conn->close();
}
?>
<!-- PHP script end -->

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
                                <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                                    <div class="form-group">
                                        <label>Name :</label>
                                        <input type="name" class="form-control" value="<?php echo $name; ?>" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label>Email :</label>
                                        <input type="email" class="form-control" value="<?php echo $email; ?>" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label>Password :</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                    <div class="form-group">
                                        <label>Gender :</label>
                                        <input type="gender" class="form-control" value="<?php echo $gender; ?>" name="gender">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Sign-Up" class="btn btn-primary btn-lg w-100" name="signup">
                                    </div>
                                    <div class="signin-link">Do you have an account? <a href="login.php">Log in here</a></div>
                                    <div class="signin-link">Are you an Curator? <a href="../admin/login.php">Log in here</a></div>
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
