<?php
    $dbhost = 'localhost';
    $dbname = 'timelyflies';
    $dbuser = 'root';
    $dbpass = 'bitnami';
    $appname = 'Timely Flies';

    mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());

    mysql_select_db($dbname) or die(mysql_error());

    function queryMysql($query) {
        $result = mysql_query($query) or die(mysql_error());
        return $result;
    }

    function destroySession() {
        $_SESSION = array();

        if (session_id() != '' || isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 2592000, '/');
        }

        session_destroy();
    }

    function sanitizeString($str) {
        $str = strip_tags($str);
        $str = htmlentities($str);
        $str = stripslashes($str);
        return mysql_real_escape_string($str);
    }

    function isDateValid($date) {
        $date = sanitizeString($date);
        if ($date == '') {
            return "";
        }

        $isDateValid = preg_match("/(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])/", "$date");

        if ($isDateValid) {
            return "";
        } else {
            return "Date must be in the form 'YYYY-MM-DD'";
        }
    }

    function areCitiesValid($start, $destination) {
        $start = sanitizeString($start);
        $destination = sanitizeString($destination);
        $errors = array();
        if (preg_match("/[^a-zA-Z\s\.]/", $start)) {
            $errors['start'] = "City name may only contain spaces, periods, A-Z, and a-z.";
        } else {
            $errors['start'] = "";
        }
        if (preg_match("/[^a-zA-Z\s\.]/", $destination)) {
            $errors['destination'] = "City name may only contain spaces, periods, A-Z, and a-z.";
        } else {
            $errors['destination'] = "";
        }
        return $errors;
    }

    function isTimeValid($time) {
        $time = sanitizeString($time);
        if (!preg_match("/^([1-9]|1[0-2]):([0-5][0-9])\s([AP]M)$/", $time)) {
            return "Time must be in the form 'HH:MM (A/P)M'. Do not use a leading 0.";
        } else {
            return "";
        }
    }

    function arePricesValid($economy, $business) {
        $economy = sanitizeString($economy);
        $business = sanitizeString($business);
        $errors = array();
        if (!preg_match("/^\d+$/", $economy)) {
            $errors['economy'] = "Price may only contain digits.";
        } else {
            $errors['economy'] = "";
        }

        if (!preg_match("/^\d+$/", $business)) {
            $errors['business'] = "Price may only contain digits.";
        } else {
            $errors['business'] = "";
        }

        return $errors;
    }

    function validateInputs($start, $destination, $date, $time, $economy, $business) {
        $errors = array();
        $cityerrors = areCitiesValid($start, $destination);
        $errors[] = $cityerrors['start'];
        $errors[] = $cityerrors['destination'];
        $errors[] = isDateValid($date);
        $errors[] = isTimeValid($time);
        $priceerrors = arePricesValid($economy, $business);
        $errors[] = $priceerrors['economy'];
        $errors[] = $priceerrors['business'];
        return $errors;
    }
?>