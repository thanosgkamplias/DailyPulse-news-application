<?php
// Συμπεριλαμβάνουμε το αρχείο κεφαλίδας (header)
require_once "include/header.php";
?>

<?php
// Σύνδεση με τη βάση δεδομένων
require_once "include/connection.php";

// Δημιουργία SQL ερωτήματος για επιλογή των δεδομένων του δημοσιογράφου που συνδέθηκε
$sql_command = "SELECT * FROM journalist WHERE email = '$_SESSION[email]' ";
$result = mysqli_query($conn , $sql_command);

if( mysqli_num_rows($result) > 0){
   while( $rows = mysqli_fetch_assoc($result) ){
       $name = ucwords($rows["name"]); // Μετατρέπουμε το όνομα σε κεφαλαίους χαρακτήρες
       $gender = ucwords($rows["gender"]); // Μετατρέπουμε το φύλο σε κεφαλαίους χαρακτήρες
       $dp = $rows["dp"]; // Διαβάζουμε το όνομα του αρχείου της φωτογραφίας προφίλ
   }

   if( empty($gender)){
       $gender = "Not Defined"; // Εάν το φύλο δεν είναι καθορισμένο, τότε θέτουμε την τιμή "Not Defined"
   }
}
?>

<div class="container">
    <div class="row">
        <div class="col-4">
        </div>
        <div class="col-12 col-lg-6 col-md-6">
            <div class="card shadow" style="width: 20rem;">
                <img src="upload/dp/<?php if(!empty($dp)){ echo $dp; }else{ echo "1.jpg"; } ?>" class="rounded img-fluid card-img-top" style="height: 300px" alt="...">
                <div class="card-body">
                    <h2 class="text-center mb-4"><?php echo $name; ?> </h2>
                    <p class="card-text">Email: <?php echo $_SESSION["email"] ?> </p>
                    <p class="card-text">Gender: <?php echo $gender ?> </p>
                    <p class="text-center">
                        <a href="edit-profile.php" class="btn btn-outline-primary">Edit Profile</a>
                        <a href="change-pass.php" class="btn btn-outline-primary">Change Password</a>
                        <a href="change-dp.php" class="mt-2 btn btn-outline-primary">Change profile photo</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Συμπεριλαμβάνουμε το αρχείο υποσέλιδου (footer)
require_once "include/footer.php";
?>