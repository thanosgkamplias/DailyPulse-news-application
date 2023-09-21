
<?php
    require_once "include/header.php";
?>
<?php

    // database connection
    require_once "include/connection.php";


    $heading_err = $detail_err = $thumbnail_err=  "";
    $heading = $detail =  $thumbnail_name= "";
    $t = 1;
    if( $_SERVER["REQUEST_METHOD"] == "POST" ){

        if( empty($_REQUEST["heading"])){
            $heading_err =  "<p style='color:red'> * Heading is Required </p>";
        }else {
          $heading = $_REQUEST["heading"];
        }

        if( empty( $_REQUEST["detail"] ) ){
            $detail_err = "<p style='color:red'> * Post Deatils Required </p>";
        }else{
           $detail = $_REQUEST["detail"];
        }

        if( empty($_FILES["thumbnail"]["name"])){
           $thumbnail_err = "<p style='color:red'> * Post Thumbnail is Required </p>";
        }else{

            $thumbnail_name = $_FILES["thumbnail"]["name"];
           $thumbnail_temp_loc = $_FILES["thumbnail"]["tmp_name"];

           $temp_extension = explode(".",$thumbnail_name);
          $thumbnail_extension = strtolower( end($temp_extension) );
          $isallowded = array("jpg","png","jpeg" );

          if( in_array( $thumbnail_extension , $isallowded ) ){
            $new_file_name =  uniqid("",true).".".$thumbnail_extension;
          $location = "upload/carousel/".$new_file_name;

          }else{
            $thumbnail_err = "<p style='color:red'> * Only JPG , JPEG and PNG files accepted </p>";
            $thumbnail_name = "";
          }
        }

        if( !empty($heading) && !empty($detail) && !empty( $thumbnail_name ) ){

            move_uploaded_file($thumbnail_temp_loc,$location);
            $current_time  = strtotime("now");

                $add_post = "UPDATE post_description SET complete_post = '$detail', p_carousel = '$new_file_name' , p_time = '$current_time' Where  p_heading = '$heading' ";
                $result_add_desc = mysqli_query($conn , $add_post);

            if($result_add_desc){

                $get_category = "SELECT p_category FROM post_description INNER JOIN post_category ON post_description.p_category = post_category.c_name  WHERE p_heading = '$heading' ";
                $result = mysqli_query($conn , $get_category);

                if($result){

                    while( $rows = mysqli_fetch_assoc($result) ){
                        $category = $rows["p_category"];
                    }
                    // increasing no of post in category by 1 when post added to that category
                    $check_no_of_post = "SELECT no_of_post FROM post_category WHERE c_name = '$category' ";
                    $chech_result = mysqli_query($conn , $check_no_of_post);
                    if( $chech_result){
                        while( $rows = mysqli_fetch_assoc($chech_result) ){
                            $no_of_post = $rows["no_of_post"];
                        }
                        $no_of_post += 1;
                        $add_no_of_post_per_cateegory = "UPDATE post_category SET no_of_post = $no_of_post WHERE c_name =  '$category' ";
                        $add_post_by_1 = mysqli_query($conn , $add_no_of_post_per_cateegory);

                        if($add_post_by_1){
                            $heading = $detail = "";
                                    echo "<script>
                                    $(document).ready( function(){
                                        $('#showModal').modal('show');
                                        $('#linkBtn').attr('href', 'manage-post-details.php');
                                        $('#linkBtn').text('View All Post Details');
                                        $('#addMsg').text('Post Details Added Successfully!');
                                        $('#closeBtn').text('Add More');
                                    })
                                </script>
                                ";
                        }
                  }
                }
            }

        }

    }
?>

<!-- ckeditor js -->
<script src="include/ckeditor/ckeditor.js"></script>

<div class="container mb-5">
    <div id="form" class="pt-5 form-input-content">
        <div class="card login-form mb-0">
            <div class="card-body pt-3 shadow">
                <h4 class="text-center">Add Post Details </h4>
                <form method="POST" enctype="multipart/form-data" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                <div class="form-group">
                        <label >Select Post Heading: </label>
                        <select name="heading" class="form-control" >
                            <option value="">Please Select a Post Heading: </option>
                            <?php
                            $get_heading = "SELECT * FROM post_description WHERE p_time IS NULL ";
                            $post_heading = mysqli_query($conn , $get_heading);

                            if(  mysqli_num_rows($post_heading) > 0  ){
                                while( $rows = mysqli_fetch_assoc($post_heading) ){
                                   $p_heading = ucwords( $rows["p_heading"] ) ;
                                    ?>

                                   <option value='<?php echo $p_heading ?>' <?php if($p_heading == $heading){ echo 'selected';} ?>  > <?php echo$p_heading ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <?php echo $heading_err; ?>
                    </div>

                    <div class="form-group">
                        <label> Add Details: </label>
                        <textarea name="detail" id="detail" ><?php echo $detail; ?></textarea>
                        <?php echo $detail_err; ?>
                    </div>
                    <div class="form-group">
                        <label> Add Thumbnail: </label>
                        <input type="file" name="thumbnail" class="form-control"  >
                        <?php echo $thumbnail_err; ?>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Submit" class="btn login-form__btn submit w-10 " name="submit_expense" >
                    </div>

                </form>
            </div>
            <!-- ckeditor function call -->
            <script>
                CKEDITOR.replace('detail');
            </script>
        </div>
    </div>
</div>




<?php
    require_once "include/footer.php";
?>
