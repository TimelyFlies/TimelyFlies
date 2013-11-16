<?php
    require_once 'header.php';

    if (isset($_SESSION['user'])) {
        destroySession();
        header('Location: http://ec2-54-226-171-226.compute-1.amazonaws.com/TimelyFlies/login.php');
    } else {
        echo "<div class='notice'><br/>You cannot log out because you are not logged in";
    }
?>

<br/><br/></div></body></html>