<?php
require_once 'functions.php';

if (isset($_POST['time'])) {
    $time = sanitizeString($_POST['time']);

    $isTimeValid = preg_match("/^([1-9]|1[0-2]):([0-5][0-9])\s([AP]M)$/", "$time");

    if ($isTimeValid === 1) {
        echo "";
    } else {
        echo "<font color='red' size='2'>Time must be in the form 'HH:MM (A/P)M'. Do not use a leading 0.</font>";
    }
}
?>