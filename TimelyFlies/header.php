<?php
    require_once 'functions.php';

    session_start();

    echo "<!DOCTYPE html>\n<html><head><script src='OSC.js'></script>";

    $userstr = '(Guest)';

    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        $loggedin = TRUE;
        $userstr = "($user)";
    } else {
        $loggedin = false;
    }

    echo "<title>$appname $userstr</title>" .
        "<link rel='stylesheet' href='styles.css' type='text/css'/>" .
        "</head><body><div class='appname'>$appname $userstr</div>";

    if ($loggedin) {
        echo "<br/><ul class='menu'>" .
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