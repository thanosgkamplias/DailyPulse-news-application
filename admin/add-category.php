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

<div class="login-form-bg h-100">
    <div class="container mt-5 h-100">
        <div class="row justify-content-center h-100">
            <div class="col-xl-6">
                <div class="form-input-content">
                    <div class="card login-form mb-0">
                        <div class="card-body pt-5 shadow">
                            <h4 class="text-center pb-3">Create Topic</h4>
                            <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                                <div class="form-group">
                                    <label>Topic Name :</label>
                                    <input type="text" class="form-control" value="<?php echo $category; ?>" name="cat_name">
                                    <?php echo $category_error; ?>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once "include/footer.php";
?>
