<?php
require_once "include/header.php";
?>

<?php
// Include the database connection
require_once "include/connection.php";

// Initialize variables
$c_id = $_GET["id"];
$fill_cat = "SELECT * FROM post_category WHERE c_id = '$c_id' ";
$result = mysqli_query($conn, $fill_cat);

if ($result) {
    while ($rows = mysqli_fetch_assoc($result)) {
        $category = trim($rows["c_name"]);
    }
}

$category_error = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate and update category name
    if (empty($_REQUEST["cat_name"])) {
        $category_error = "<p style='color:red'> * Category Name Required</p>";
    } else {
        $category = $_REQUEST["cat_name"];
    }

    if (!empty($category)) {
        // Check if the new category name already exists
        $cat_select = "SELECT * FROM post_category WHERE c_name = '$category' ";
        $result = mysqli_query($conn, $cat_select);

        if (mysqli_num_rows($result) > 0) {
            $category_error = "<p style='color:red'>* Category already exists</p>";
        } else {
            // Update the category name in the database
            $add_cat = "UPDATE post_category SET c_name = '$category' WHERE c_id = '$c_id' ";
            $add = mysqli_query($conn, $add_cat);

            if ($add) {
                $category = "";
                echo "<script>
                    $(document).ready( function(){
                        $('#showModal').modal('show');
                        $('#linkBtn').attr('href', 'manage-category.php');
                        $('#linkBtn').text('View All Categories');
                        $('#addMsg').text('Category Edited Successfully!');
                        $('#closeBtn').text('Edit Again');
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
                            <h4 class="text-center pb-3">Edit Topic</h4>
                            <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                                <div class="form-group">
                                    <label>Topic Name:</label>
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
</div>
<?php
require_once "include/footer.php";
?>
