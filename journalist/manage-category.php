<?php
// Συμπεριλαμβάνουμε το αρχείο κεφαλίδας (header)
require_once "include/header.php";
?>

<?php
// Σύνδεση με τη βάση δεδομένων
require_once "include/connection.php";

// Ερώτημα SQL για επιλογή όλων των κατηγοριών θέματος
$sql = "SELECT * FROM post_category";
$result = mysqli_query($conn , $sql);

$i = 1; // Μεταβλητή για αρίθμηση των κατηγοριών
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

<div class="container bg-white shadow">
    <div class="py-4 mt-5">
    <div class='text-center pb-2'><h4>Manage Topics</h4></div>
    <table style="width:100%" class="table-hover text-center ">
    <tr class="bg-dark">
        <th>S.No.</th>
        <th>Topic Name</th>
        <th>No. of Posts</th>
        <th>Modify</th>
    </tr>
    <?php

    if( mysqli_num_rows($result) > 0){
        while( $rows = mysqli_fetch_assoc($result) ){
            $c_name= $rows["c_name"];
            $no_of_post = $rows["no_of_post"];
            $c_id = $rows["c_id"];
            ?>
        <tr>
        <td><?php echo "{$i}."; ?></td>
        <td> <?php echo ucwords($c_name) ; ?></td>
        <td><?php echo $no_of_post; ?></td>
        <td>   <?php
                // Εμφανίζουμε ένα κουμπί επεξεργασίας με σύνδεσμο προς τη σελίδα επεξεργασίας κατηγορίας
                $edit_icon = "<a href='edit-category.php?id={$c_id}' class='btn-sm btn-primary float-right '> <span ><i class='fa fa-edit '></i></span> </a>";
                echo  $edit_icon;
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
