<?php
require_once 'header.php';
$path = "/opt/bitnami/apache2/htdocs/TimelyFlies/";

if ($loggedin) {
    if (isset($_SESSION['user'])) {
        $user = sanitizeString($_SESSION['user']);
        $path .= $user . "/";
        echo "<div id='container'><div id='header' class='header'><h1>File Uploader</h1></div>";

        echo "<h4>You can use this tool to upload files such as tickets or boarding passes. Permitted extensions are ";
        $allowedextensions = array("gif", "jpeg", "jpg", "png", "pdf");
        $size = count($allowedextensions);
        
        for($i = 0; $i < $size-1; $i++)
        {
                  echo "$allowedextensions[$i], ";
        }
        $lastelement = $size - 1;
        echo "and $allowedextensions[$lastelement]. ";

        echo "<div id='menu' class='menubar'>";
        echo "<form action='uploader.php' method='post'";
        echo "enctype='multipart/form-data'>";
        echo "<label for='file'>Filename:</label>";
        echo "<input type='file' name='file' id='file'/><br/>";
        echo "<input type='submit' name='submit' value='Upload'/>";
        echo "</form>";
        echo "</div>";

        echo "<div id='flights' class='main'>";
        echo "<br><br/>";
        echo "<h4>Your Files:</h4>";
        //echo "List user's files here<br/><br/>";
        if ($handle = opendir("$path")) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $filepath = "$user/$entry";
                    echo "<a href='viewfile.php' file = $entry>$entry</a>";
                    echo "<br/><br/>";
                }
            }
            closedir($handle);
        }
        echo "</div></div>";
    } else {
        echo "Error with user account";
    }
    echo "</body></html>";
} else {
    die("You are not logged in. Please <a href='login.php'>click here</a> to log in.");

}
?>
