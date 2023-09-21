<?php
// Έναρξη της συνεδρίας
session_start();

// Καθαρισμός όλων των μεταβλητών της συνεδρίας
session_unset();

// Καταστροφή της συνεδρίας
session_destroy();

// Ανακατεύθυνση του χρήστη στη σελίδα σύνδεσης (login.php) με μήνυμα επιτυχούς αποσύνδεσης
header("Location: login.php?logout-success");
?>
