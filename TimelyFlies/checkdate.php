<?php
require_once 'functions.php';

if (isset($_POST['date'])) {
    $date = sanitizeString($_POST['date']);

    $isDateValid = preg_match("/20\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])/", "$date");

    if ($isDateValid) {
        echo "";
    } else {
        echo "Date must be in the form 'YYYY-MM-DD'";
    }
}
?>