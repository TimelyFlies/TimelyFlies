<?php
    require_once 'header.php';

if (!$loggedin) {
    echo "<div class='notice'><h3>Please enter your details to log in</h3>";
    $error = $user = $pass = '';

    if (isset($_POST['user'])) {
        $user = sanitizeString($_POST['user']);
        $pass = sanitizeString($_POST['pass']);

        if ($user == "" || $pass == "") {
            $error = "Not all fields were entered<br/>";
        } else {
            $hashedpass = sha1($pass);
            $query = "SELECT * FROM users WHERE username='$user' AND password='$hashedpass'";
            $result = queryMysql($query);

            if (mysql_num_rows($result) == 0) {
                $error = "<span class='error'>Username/Password invalid</span><br/><br/>";
            } else {
                $result = mysql_fetch_row($result);
                $_SESSION['user'] = $user;
                $_SESSION['pass'] = $pass;
                $_SESSION['is_admin'] = $result[2];
                if (isset($_POST['start']) && isset($_POST['destination']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['class']) && isset($_POST['flighttable'])) {
                    $_SESSION['start'] = sanitizeString($_POST['start']);
                    $_SESSION['destination'] = sanitizeString($_POST['destination']);
                    $_SESSION['flighttable'] = sanitizeString($_POST['flighttable']);
                    $_SESSION['date'] = sanitizeString($_POST['date']);
                    $_SESSION['time'] = sanitizeString($_POST['time']);
                    $_SESSION['class'] = ucfirst(sanitizeString($_POST['class']));
                    echo "<script>" .
                    "window.location.assign('http://ec2-54-226-171-226.compute-1.amazonaws.com/TimelyFlies/ticketing.php');" .
                    "</script>";
                }
                die("You are now logged in. Please <a href='browse.php'>click here</a> to continue.<br/><br/>");
            }
        }
    }

$hiddenFields = "";

if (isset($_POST['start']) && isset($_POST['destination']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['class']) && isset($_POST['flighttable'])) {
    $start = sanitizeString($_POST['start']);
    $destination = sanitizeString($_POST['destination']);
    $flighttable = sanitizeString($_POST['flighttable']);
    $date = sanitizeString($_POST['date']);
    $time = sanitizeString($_POST['time']);
    $class = ucfirst(sanitizeString($_POST['class']));

    $hiddenFields = "<input type='hidden' name='start' value='$start'/>" .
                "<input type='hidden' name='flighttable' value='$flighttable'/>" .
                "<input type='hidden' name='class' value='$class'/>" .
                "<input type='hidden' name='destination' value='$destination'/>" .
                "<input type='hidden' name='date' value='$date'/>" .
                "<input type='hidden' name='time' value='$time'/>";
}

echo<<<_END
    <form method='post' action='login.php'>$error
    <span class='fieldname'>Username</span><input type='text'
        maxlength='16' name='user' value='$user' required/><br/>
    <span class='fieldname'>Password</span><input type='password'
        maxlength='16' name='pass' value='$pass' required/>
    $hiddenFields
    <br/>
    <span class='fieldname'>&nbsp;</span>
    <input type='submit' value='Log in'/>
    </form><br/></div></body></html>
_END;
} else {
    die("You are already logged in.");
}
