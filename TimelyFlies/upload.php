<?php
require_once 'header.php';

  echo "<form action='uploader.php' method='post'";
  echo "enctype='multipart/form-data'>";
  echo "<label for='file'>Filename:</label>";
  echo "<input type='file' name='file' id='file'><br>";
  echo "<input type='submit' name='submit' value='Submit'>";
  echo "</form>";
?>
