<?php
// Συμπερίληψη του αρχείου header.php
require_once "include/header.php";
?>
<section id="contentSection">
    <div class="row">
        <div class="col-12">
            <div class="left_content">
                <div class="contact_area">
                    <?php
                    // Επιλογή των πληροφοριών επικοινωνίας από τον πίνακα contact_us
                    $get_details = "SELECT * FROM contact_us ORDER BY id DESC LIMIT 1";
                    $get_details_result = mysqli_query($conn , $get_details);
                    if($get_details_result){
                        while ($rows = mysqli_fetch_assoc($get_details_result) ){
                            $address = ucwords($rows["address"]);
                            $phn = $rows["phn"];
                            $email = ucfirst($rows["email"]);
                            ?>
                            <!-- Εμφάνιση χάρτη Google με τη διεύθυνση -->
                            <iframe src="https://www.google.com/maps?q=<?php echo $address; ?>&output=embed" style="border:3; height:400px; width:100%;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="left_content">
                        <div class="contact_area">
                            <h2>Επικοινωνηστε Μαζι μας</h2>
                            <form action="#" class="contact_form">
                                <input class="form-control" type="text" placeholder="Ονομα*">
                                <input class="form-control" type="email" placeholder="Email*">
                                <textarea class="form-control" cols="30" style="resize: none;" rows="10" placeholder="Μηνυμα*"></textarea>
                                <input type="submit" value="Αποστολη Μηνυματος">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="right_content" style=" position: relative;">
                        <div class="contact_area" style="font-size:20px;" >
                            <h2>Μπορειτε να μας βρειτε</h2>
                            <!-- Εμφάνιση διεύθυνσης, τηλεφώνου και email επικοινωνίας -->
                            <p ><i style="font-size:29px;" class="fa fa-map-marker" aria-hidden="true"></i>
                                &nbsp;&nbsp;
                                Διευθυνση: <span style="text-align: justify; width: 100px;"> <?php echo $address; ?> </span>
                            </p>
                            <p><i style="font-size:29px;" class="fa fa-phone" aria-hidden="true"></i>
                                &nbsp;&nbsp; Αριθμος Τηλεφωνου: <a href="tel:<?php echo $phn ?>"> <?php echo $phn; ?> </a> </p>
                            <p ><i style="font-size:29px;" class="fa fa-location-arrow fa-10x" aria-hidden="true"></i>
                                &nbsp; &nbsp; Email: <a href="mailto:<?php echo $email; ?>"> <?php echo $email; ?> </a></p>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- Κλείσιμο της σειράς -->
    </div>
</section>
<footer id="footer">
    <div class="footer_top">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="footer_widget wow fadeInDown">
                    <h2>Θεματα</h2>
                    <ul class="tag_nav">
                        <!-- Προσθήκη κατηγοριών ειδήσεων -->
                        <?php
                        $get_category = "SELECT * FROM post_category";
                        $result = mysqli_query($conn , $get_category);
                        if($result){
                            while ( $rows =  mysqli_fetch_assoc($result) ){
                                $c_name = $rows["c_name"]
                                ?>
                                <li><a href="read-category.php?category=<?php echo $c_name; ?> "> <?php echo ucwords($c_name); ?></a></li>
                                <?php
                            }
                        }
                        ?>
                        <!-- Τέλος προσθήκης κατηγοριών ειδήσεων -->
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="footer_widget wow fadeInRightBig">
                    <?php
                    // Επιλογή των πληροφοριών επικοινωνίας από τον πίνακα contact_us
                    $get_details = "SELECT * FROM contact_us ORDER BY id DESC LIMIT 1";
                    $get_details_result = mysqli_query($conn , $get_details);
                    if($get_details_result){
                        while ($rows = mysqli_fetch_assoc($get_details_result) ){
                            $address = ucwords($rows["address"]);
                            $phn = $rows["phn"];
                            $email = ucfirst($rows["email"]);
                            ?>
                            <h2>Επικοινωνία</h2>
                            <p>Επικοινωνήστε μαζί μας οποιαδήποτε στιγμή.</p>
                            <address>
                                <P>Διευθυνση : <?php echo $address; ?></P>
                                <P>Αριθμος Τηλεφωνου: <a  style="color:rgb(218,218,218);" href="tel:<?php echo $phn ?>"> <?php echo $phn; ?> </a></P>
                                <p>Email : <a style="color:rgb(218,218,218);" href = "mailto:<?php echo $email; ?>"> <?php echo $email; ?> </a> </p>
                            </address>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_bottom">
        <p class="copyright">Copyright &copy; <?php echo date("Y" , strtotime("now") ); ?> <a href="./index.php">DailyPulse</a></p>
        <!-- Wpfreeware -->
    </div>
</footer>
</div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/wow.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/slick.min.js"></script>
<script src="assets/js/jquery.li-scroller.1.0.js"></script>
<script src="assets/js/jquery.newsTicker.min.js"></script>
<script src="assets/js/jquery.fancybox.pack.js"></script>
<script src="assets/js/custom.js"></script>
</body>
</html>
