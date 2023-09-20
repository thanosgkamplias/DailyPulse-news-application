<?php
// Συμπερίληψη του αρχείου header.php
require_once "include/header.php";
?>
<?php
// Λήψη της παραμέτρου 'id' από το URL
$id = $_GET["id"];

// Επιλογή όλων των στοιχείων από τον πίνακα post_description με βάση το 'id'
$read_news = "SELECT * FROM post_description WHERE p_id = '$id' ";
$read_result = mysqli_query($conn, $read_news);

// Έλεγχος εάν υπάρχουν αποτελέσματα
if ($read_result) {
    while ($rows = mysqli_fetch_assoc($read_result)) {
        $heading =  $rows["p_heading"];
        $details =  $rows["complete_post"];
        $time = $rows["p_time"];
        $category = $rows["p_category"];
        $img = $rows["p_carousel"];
?>
<section id="contentSection">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="left_content">
                <div class="single_page">
                    <h1><?php echo $heading; ?></h1>
                    <div class="post_commentbox">
                        <a href="#"><i class="fa fa-user"></i>user</a>
                        <span><i class="fa fa-calendar"></i> <?php echo date('d-M-Y ', $time); ?></span>
                        <a href="#"><i class="fa fa-tags"></i><?php echo $category; ?></a>
                    </div>
                    <div class="single_page_content">
                        <img class="img-center" style="width:80%; height:300px"
                            src="admin/upload/carousel/<?php echo $img; ?>" alt="">
                        <blockquote><?php echo $details; ?></blockquote>

                        <!-- Comment Section -->
                        <section id="commentSection" class="bg-light py-5">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-6 offset-lg-2">
                                        <h2 class="mb-4">Σχολια</h2>
                                        <?php
                                        // Επιλογή όλων των σχολίων για το άρθρο με βάση το 'id' και ταξινόμηση κατά φθίνουσα χρονολογική σειρά
                                        $fetch_comments_query = "SELECT * FROM comments WHERE news_id = '$id' ORDER BY timestamp DESC";
                                        $comments_result = mysqli_query($conn, $fetch_comments_query);

                                        // Έλεγχος εάν υπάρχουν σχόλια
                                        if ($comments_result && mysqli_num_rows($comments_result) > 0) {
                                            while ($comment = mysqli_fetch_assoc($comments_result)) {
                                                echo "<div class='comment'>";
                                                echo "<strong>" . $comment['user_name'] . " | </strong>";
                                                echo "<span class='timestamp'>" . $comment['timestamp'] . "</span>";
                                                echo "<p class='comment-text'>" . $comment['comment_text'] . "</p>";
                                                echo "</div>";
                                            }
                                        } else {
                                            echo "<div>No comments yet.</div>";
                                        }
                                        ?>
                                        <h3 class="mt-4">Προσθηκη Σχολιων</h3>
                                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
                                            method="POST">
                                            <input type="hidden" name="news_id" value="<?php echo $id; ?>">
                                            <div class="form-group">
                                                <label for="user_name">Ονομα:</label>
                                                <input type="text" id="user_name" name="user_name" required
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="comment_text">Σχολιο:</label>
                                                <textarea id="comment_text" name="comment_text" rows="4" required
                                                    class="form-control"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Υποβολη Σχολιων</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="related_post">
                            <h2>Σχετικά Άρθρα <i class="fa fa-thumbs-o-up"></i></h2>
                            <ul class="spost_nav wow fadeInDown animated">
                                <?php
                                // Επιλογή τυχαίων σχετικών άρθρων από τον ίδιο κατηγορία
                                $selet_related_post = "SELECT * FROM post_description WHERE p_category = '$category' ORDER BY RAND() LIMIT 3 ";
                                $relted_post = mysqli_query($conn, $selet_related_post);
                                if ($relted_post) {
                                    while ($relted_post_row = mysqli_fetch_assoc($relted_post)) {
                                        $thumb = $relted_post_row["p_thumbnail"];
                                        $related_heading = $relted_post_row["p_heading"];
                                        $related_id = $relted_post_row["p_id"];
                                ?>
                                <li>
                                    <div class="media"> <a class="media-left"
                                            href="read-post.php?id=<?php echo $related_id; ?>"> <img
                                                src="admin/upload/thumbnail/<?php echo $thumb; ?>" alt=""> </a>
                                        <div class="media-body"> <a class="catg_title"
                                                href="read-post.php?id=<?php echo $related_id; ?>"
                                                "> <?php echo $related_heading; ?> </a> </div>
                  </div>
                </li>
                  <?php
                }
              }
            ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <?php
    }
  }
?>
<?php
// Εάν η φόρμα έχει υποβληθεί, εισαγωγή του σχολίου στη βάση δεδομένων
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $news_id = $_POST['news_id'];
    $user_name = $_POST['user_name'];
    $comment_text = $_POST['comment_text'];

    // Εισαγωγή του σχολίου στον πίνακα comments
    $insert_comment_query = "INSERT INTO comments (news_id, user_name, comment_text) VALUES ('$news_id', '$user_name', '$comment_text')";
    $insert_result = mysqli_query($conn, $insert_comment_query);

    if ($insert_result) {
        echo "<script>alert('Comment submitted successfully.');</script>";
        echo '<script>window.location.href = "read-post.php?id=' . $news_id . '";</script>';
        exit(); // Τερματισμός του σεναρίου μετά την ανακατεύθυνση
    } else {
        echo "Error: " . $insert_comment_query . "<br>" . mysqli_error($conn);
    }
}

// Συμπερίληψη του αρχείου footer.php
require_once "include/footer.php";
?>
