<?php
  require_once 'header.php';

  if($loggedin)
  {
	echo "<div id='container'><div id='header' class='header'><h1>File Uploader</h1></div>";
	echo "<h4>You can use this tool to upload files such as tickets or boarding passes</h4>";
	echo "<div id='menu' class='menubar'>";
	echo "<form action='uploader.php' method='post'";
        echo "enctype='multipart/form-data'>";
        echo "<label for='file'>Filename:</label>";
        echo "<input type='file' name='file' id='file'/><br>";
        echo "<input type='submit' name='submit' value='Upload'/>";
        echo "</form>";
	echo "</div>";
	echo "</div>";
	echo "<div id='flights' class='main'>";
	echo "<h4>Your Files:</h4>";
	echo "List user's files here";
	echo "</div>";
    echo "</body></html>";
  }
  else
  {
    die("You must be logged in to view this page.");
  }
?>
