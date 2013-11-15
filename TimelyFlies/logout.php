<?php
    require_once 'header.php';

    if (isset($_SESSION['user'])) {
        destroySession();
        header('Location: http://127.0.0.1/TimelyFlies/login.php');
    } else {
        echo "<div class='main'><br/>You cannot log out because you are not logged in";
    }
?>

<br/><br/></div></body></html>