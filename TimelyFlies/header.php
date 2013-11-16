<?php
    require_once 'functions.php';

    session_start();

    echo "<!DOCTYPE html>\n<html><head><script src='OSC.js'></script>";
    echo "<script src='ajax.js'></script>";
    echo "<script src='functions.js'></script>";

    $userstr = '(Guest)';

    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        $is_admin = $_SESSION['is_admin'];
        $loggedin = TRUE;
        $userstr = "($user)";
    } else {
        $loggedin = FALSE;
        $is_admin = FALSE;
    }

    echo "<title>$appname $userstr</title>" .
        "<link rel='stylesheet' href='styles.css' type='text/css'/>" .
        "</head><body><div class='appname'>$appname $userstr</div>";

    if ($loggedin && !$is_admin) {
        echo "<br/><ul class='menu'>" .
            "<li><a href='browse.php'>Browse Flights</a></li>" .
            "<li><a href='booking.php'>Book Flight</a></li>" .
            "<li><a href='upload.php'>Upload Documents</a></li>" .
            "<li><a href='logout.php'>Log Out</a></li></ul><br/>";
    } else if ($loggedin && $is_admin) {
        echo "<br/><ul class='menu'>" .
            "<li><a href='addflights.php'>Add Flights</a></li>" .
            "<li><a href='browse.php'>Browse Flights</a></li>" .
            "<li><a href='booking.php'>Book Flight</a></li>" .
            "<li><a href='upload.php'>Upload Documents</a></li>" .
            "<li><a href='logout.php'>Log Out</a></li></ul><br/>";
    } else {
        echo "<br/><ul class='menu'>" .
            "<li><a href='browse.php'>Browse Flights</a></li>" .
            "<li><a href='signup.php'>Sign Up</a></li>" .
            "<li><a href='login.php'>Log In</a></li></ul><br/>";
    }
?>