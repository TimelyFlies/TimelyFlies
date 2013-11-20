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
        $date = sanitizeString($_POST['date']);
        if ($date == '') {
            return "";
        }

        $isDateValid = preg_match("/(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])/", "$date");

        if ($isDateValid) {
            return "";
        } else {
            return "<font color='yellow' size='2'><i>Date must be in the form 'YYYY-MM-DD'</font>";
        }
    }
?>
