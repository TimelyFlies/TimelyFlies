<?php
require_once 'functions.php';

if (isset($_POST['price'])) {
    $price = sanitizeString($_POST['price']);

    $isPriceValid = preg_match("/^\d+$/", "$price");

    if ($isPriceValid === 1) {
        echo "";
    } else {
        echo "<font color='red' size='2'>Price should only contain digits.</font>";
    }
}
?>