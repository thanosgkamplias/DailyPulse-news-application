<?php
require_once "include/header.php";
?>

<?php
// Include the database connection
require_once "include/connection.php";

// Total number of posts
$select_total_post = "SELECT * FROM post_description WHERE p_time IS NOT NULL";
$total_post_result  = mysqli_query($conn , $select_total_post);

// Selecting category details
$sql = "SELECT * FROM post_category";
$result = mysqli_query($conn , $sql);
$i = 1;

// Selecting contact details
$phn_no = $email = $address = "";
$get_contact = "SELECT * FROM contact_us ORDER BY id DESC LIMIT 1";
$get_contact_result = mysqli_query($conn , $get_contact);

if($get_contact_result){
    while($contact_row = mysqli_fetch_assoc($get_contact_result)){
        $phn_no = $contact_row["phn"];
        $email = $contact_row["email"];
        $address = $contact_row["address"];
    }
}
?>

<style>
table, th, td {
  border: 1px solid black;
  padding: 5px;
}
table {
  border-spacing: 10px;
}
</style>

<div class="container mb-5">
    <div class="row mt-5">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card shadow">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">Post Topic</li>
                    <li class="list-group-item">Total Topics: <span class="text-center"> <?php echo mysqli_num_rows($result); ?> </span> </li>
                    <li class="list-group-item text-center"><a href="manage-category.php"><b>View All Topics</b></a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card shadow">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">Topic's Details</li>
                    <li class="list-group-item">
                         <table style="width:100%" class="table-hover text-center">
                             <tr class="bg-dark">
                                  <th>Topic Name</th>
                                  <th>No. of Posts</th>
                             </tr>
                             <?php
                                  if( mysqli_num_rows($result) > 0){
                                    while( $rows = mysqli_fetch_assoc($result) ){
                                         $c_name= $rows["c_name"];
                                         $no_of_post = $rows["no_of_post"];
                                          $c_id = $rows["c_id"];
                               ?>
                             <tr>
                                 <td> <?php echo ucwords($c_name) ; ?></td>
                                 <td><?php echo $no_of_post; ?></td>
                                <?php
                                        $i++;
                                        }
                                    }else{
                                        echo "No category found";
                                    }
                                ?>
                             </tr>
                             </table>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card shadow">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">Post's Detail</li>
                    <li class="list-group-item text-left">Total Posts : <?php
                        if($total_post_result){
                            echo mysqli_num_rows($total_post_result);
                        }
                    ?></li>
                    <li class="list-group-item text-center"><a href="manage-post-desc.php"><b>View All Posts</b></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- 2nd row start -->
    <div class="row mt-5">
        <div class="col-lg-6 col-md-6 col-sm-12 ">
            <div class="card shadow">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center"> <b>Contact Details </b> </li>
                    <li class="list-group-item"><b>  Address : </b>  <?php echo $address; ?> </li>
                    <li class="list-group-item"><b> Phone No. :  </b>   <?php echo $phn_no; ?> </li>
                    <li class="list-group-item"><b>  Email : </b>   <?php echo $email; ?></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 ">
            <div class="card shadow">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center"> <b>Location </b> </li>
                    <li class="list-group-item"> <iframe src="https://www.google.com/maps?q=<?php echo $address; ?>&output=embed" style=" height:230px; width:100%;" allowfullscreen="" loading="lazy"></iframe></li>
                </ul>
            </div>
        </div>
    </div>
<?php
    require_once "include/footer.php";
?>
