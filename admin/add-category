<?php
require_once "include/header.php";
?>

<?php
// Αρχικοποίηση μεταβλητών για τον έλεγχο της φόρμας
$category_error = $category = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Έλεγχος εάν η μεταβλητή cat_name είναι κενή
    if (empty($_REQUEST["cat_name"])) {
        $category_error = "<p style='color:red'> * Category Name Require</p>";
    } else {
        $category = $_REQUEST["cat_name"];
    }

    if (!empty($category)) {
        // Σύνδεση στη βάση δεδομένων
        require_once "include/connection.php";

        // Εκτέλεση ερωτήματος για έλεγχο της κατηγορίας
        $cat_select = "SELECT * FROM post_category WHERE c_name = '$category'";
        $result = mysqli_query($conn, $cat_select);

        if (mysqli_num_rows($result) > 0) {
            $category_error = "<p style='color:red'>* Category already exist </p>";
        } else {
            // Προσθήκη νέας κατηγορίας
            $add_cat = "INSERT INTO post_category( c_name ) VALUES( '$category' ) ";
            $add = mysqli_query($conn, $add_cat);
            if ($add) {
                // Εμφάνιση μηνύματος επιτυχούς προσθήκης
                echo "<script>
                    $(document).ready( function(){
                        $('#showModal').modal('show');
                        $('#linkBtn').attr('href', 'manage-category.php');
                        $('#linkBtn').text('View All Categories');
                        $('#addMsg').text('Category Added Successfully!');
                        $('#closeBtn').text('Add More');
                    })
                </script>";
            }
        }
    }
}
?>
