<?php
if ($_FILES["file"]["error"] > 0)
{
	echo "Error: " . $_FILES["file"]["error"] . "<br>";
}
else
{
	echo "Upload: " . $_FILES["file"]["name"] . "<br>";
	echo "Type: " . $_FILES["file"]["type"] . "<br>";
	echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
	echo "Temp file: " . $_FILES["file"]["tmp_name"];
}
if (file_exists("/opt/bitnami/apache2/htdocs/TimelyFlies/david/" . $_FILES["file"]["name"]))
{
  echo $_FILES["file"]["name"] . " already exists. ";
}
else
{
  move_uploaded_file($_FILES["file"]["tmp_name"], "/opt/bitnami/apache2/htdocs/TimelyFlies/david/" . $_FILES["file"]["name"]);
  echo "<br> </br>";
  echo "Stored in: " . "/opt/bitnami/apache2/htdocs/TimelyFlies/david/" . $_FILES["file"]["name"];
}
?>
