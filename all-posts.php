<?php
// Συμπερίληψη του αρχείου header.php
require_once "include/header.php";
?>
<section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="single_post_content">
                <!-- Εμφάνιση του τίτλου "Όλες οι ειδήσεις" -->
                <h2><span>Ολες οι ειδησεις</span></h2>
                <!-- Προσθήκη όλων των ειδήσεων από τον πίνακα post_description -->
                <?php
                $select_cat_news = "SELECT * FROM post_description ORDER BY p_time DESC ";
                $result_cat_news = mysqli_query($conn , $select_cat_news);
                if($result_cat_news){
                    while ( $cat_news_rows = mysqli_fetch_assoc($result_cat_news) ){
                        $post_thumb = $cat_news_rows["p_thumbnail"];
                        $post_heading = $cat_news_rows["p_heading"];
                        $post_id = $cat_news_rows["p_id"];
                        $post_desc = $cat_news_rows["p_description"];
                        $post_id = $cat_news_rows["p_id"];
                ?>
                <!-- Εσωτερική σειρά καρτών για την εμφάνιση των ειδήσεων -->
                <div class="row">
                    <div class="card">
                        <div class="col-lg-4">
                            <!-- Σύνδεση με τη σελίδα read-post.php με τον αναγνωριστικό της είδησης -->
                            <a href="read-post.php?id=<?php echo $post_id; ?>" > <img  style="height:150px; width:100%; " class="card-img img-fluid img-responsive" src="admin/upload/thumbnail/<?php echo $post_thumb; ?>"> </a>
                        </div>
                        <div class="card-body">
                            <!-- Εμφάνιση του τίτλου της είδησης ως σύνδεσμος προς τη σελίδα read-post.php -->
                            <div class="card-text"> <a href="read-post.php?id=<?php echo $post_id; ?>" > <h3> <?php echo ucwords($post_heading); ?> </h3> </a> </div>
                            <!-- Εμφάνιση της περιγραφής της είδησης -->
                            <div class="card-text"> <a href="read-post.php?id=<?php echo $post_id ?>" ><?php echo ucwords($post_desc); ?> </a> </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                }
                ?>
                <!-- Τέλος εσωτερικής σειράς καρτών -->
            </div>
        </div>
      </div>
<?php
// Συμπερίληψη του αρχείου footer.php
require_once "include/footer.php";
?>
