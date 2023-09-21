<?php
// Συμπεριλαμβάνουμε το αρχείο κεφαλίδας (header)
require_once "include/header.php";
?>

<?php
// Σύνδεση με τη βάση δεδομένων
require_once "include/connection.php";

// Ερώτημα SQL για επιλογή όλων των περιγραφών θέματος, ταξινομημένων κατά φθίνουσα σειρά ως προς το p_id
$sql = "SELECT * FROM post_description ORDER BY p_id DESC ";
$result = mysqli_query($conn , $sql);

$i = 1; // Μεταβλητή για αρίθμηση των περιγραφών

?>

<style>
table, th, td {
  border: 1px solid black;
  padding: 15px;
}
table {
  border-spacing: 10px;
}
</style>

<div class="container bg-white shadow mb-5">
    <div class="py-4 mt-5">
    <div class='text-center pb-2'><h4>Manage Post Description</h4></div>
    <table style="width:100%" class="table-hover text-center ">
    <tr class="bg-dark">
        <th>S.No.</th>
        <th>Post Heading</th>
        <th>Post Description</th>
        <th>Post Thumbnail</th>
        <th>Modify</th>
    </tr>
    <?php

    if( mysqli_num_rows($result) > 0){
        while( $rows = mysqli_fetch_assoc($result) ){
            $p_heading= $rows["p_heading"];
            $p_description = $rows["p_description"];
            $p_thumbnail = $rows["p_thumbnail"];
            $p_id = $rows["p_id"];
            $p_cat = $rows["p_category"];
            ?>
        <tr>
        <td><?php echo "{$i}."; ?></td>
        <td> <?php echo ucwords($p_heading) ; ?></td>
        <td><?php echo $p_description; ?></td>
        <td> <img src="upload/thumbnail/<?php echo $p_thumbnail;?> " class="img-fluid" style="height:70px"> </td>

        <td>   <?php
                // Εμφανίζουμε ένα κουμπί επεξεργασίας με σύνδεσμο προς τη σελίδα επεξεργασίας περιγραφής
                $edit_icon = "<a href='edit-post-desc.php?id={$p_id}' class='btn-sm btn-primary float-right '> <span ><i class='fa fa-edit '></i></span> </a>";
                echo   $edit_icon;
             ?>
        </td>

    <?php
            $i++;
            }
        }else{
        echo "no topic found";
        }
    ?>
     </tr>
    </table>
    </div>
</div>

<?php
// Συμπεριλαμβάνουμε το αρχείο υποσέλιδου (footer)
require_once "include/footer.php";
?>
