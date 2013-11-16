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
                die("You are now logged in. Please <a href='browse.php'>click here</a> to continue.<br/><br/>");
            }
        }
    }

echo <<<_END
    <form method='post' action='login.php'>$error
    <span class='fieldname'>Username</span><input type='text'
        maxlength='16' name='user' value='$user'/><br/>
    <span class='fieldname'>Password</span><input type='password'
        maxlength='16' name='pass' value='$pass'/>

    <br/>
    <span class='fieldname'>&nbsp;</span>
    <input type='submit' value='Log in'/>
    </form><br/></div></body></html>
_END;
} else {
    die("You are already logged in.");
}
