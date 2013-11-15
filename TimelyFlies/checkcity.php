<?php
require_once 'functions.php';

if (isset($_POST['city'])) {
    $city = sanitizeString($_POST['city']);

    $isCityValid = preg_match("/[^a-zA-z\s]/", "$city");

    if ($isCityValid === 0) {
        echo "";
    } else {
        echo "<font color='red' size='2'>City name may only contain spaces, A-Z, and a-z.</font>";
    }
}
?>