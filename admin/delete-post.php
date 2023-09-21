<?php
// Συμπεριλαμβάνουμε το αρχείο σύνδεσης στη βάση δεδομένων
require_once "include/connection.php";

// Λαμβάνουμε την παράμετρο 'id' από το URL για το άρθρο που θα διαγράψουμε
$p_id = $_GET["id"];

// Λαμβάνουμε την παράμετρο 'category' από το URL για την κατηγορία του άρθρου
$p_cat = $_GET["category"];

// Επιλέγουμε τον αριθμό των άρθρων που υπάρχουν στην κατηγορία '$p_cat'
$select_no_of_post_per_cat = "SELECT * FROM post_category WHERE c_name  = '$p_cat' ";
$result_post = mysqli_query($conn , $select_no_of_post_per_cat);
if($result_post){
    while( $rows = mysqli_fetch_assoc($result_post) ){
        $no_of_post = $rows["no_of_post"];
        $no_of_post -= 1; // Μειώνουμε τον αριθμό των άρθρων κατά 1
    }

    // Ενημερώνουμε τον αριθμό των άρθρων στον πίνακα post_category
    $update = "UPDATE post_category SET no_of_post = '$no_of_post' WHERE c_name = '$p_cat' ";
    $result_update = mysqli_query( $conn , $update);
}

// Διαγράφουμε το άρθρο από τον πίνακα post_description με βάση το 'p_id'
$delete_cat = "DELETE FROM post_description WHERE p_id = '$p_id' ";
$result = mysqli_query($conn , $delete_cat);

// Εάν η διαγραφή είναι επιτυχής, ανακατευθύνουμε τον χρήστη στη σελίδα διαχείρισης κατηγοριών με μήνυμα επιτυχίας
if($result ){
    header("Location: manage-post-desc.php?delete-success");
}
?>
