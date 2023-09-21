<?php
// Συμπεριλαμβάνουμε το αρχείο σύνδεσης στη βάση δεδομένων
require_once "include/connection.php";

// Λαμβάνουμε την παράμετρο 'id' από το URL για τον καθορισμό ποιας κατηγορίας θα διαγράψουμε
$c_id = $_GET["id"];

// Διαγράφουμε την κατηγορία από τον πίνακα post_category με βάση το 'c_id'
$delete_cat = "DELETE FROM post_category WHERE c_id = '$c_id' ";

// Εκτελούμε το ερώτημα στη βάση δεδομένων
$result = mysqli_query($conn , $delete_cat);

// Εάν η διαγραφή είναι επιτυχής, ανακατευθύνουμε τον χρήστη στη σελίδα διαχείρισης κατηγοριών με μήνυμα επιτυχίας
if($result ){
    header("Location: manage-category.php?delete-success");
}
?>
