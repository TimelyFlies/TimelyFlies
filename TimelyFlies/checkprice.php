<?php
require_once 'functions.php';

if (isset($_POST['price'])) {
    $price = sanitizeString($_POST['price']);

    $isPriceValid = preg_match("/^\d+$/", "$price");

    if ($isPriceValid === 1) {
        echo "";
    } else {
        echo "Price should only contain digits.";
    }
}
?>