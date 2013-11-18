<?php
require_once 'header.php';
$path = "/opt/bitnami/apache2/htdocs/TimelyFlies/";
echo "<div class='header'><h1>Upload Confirmation</h1></div>";
if ($loggedin)
{
	echo "<div class='main'>";
	if (isset($_SESSION['user']))
	{
	        $user = sanitizeString($_SESSION['user']);
	        $path .= $user . "/";
		if ($_FILES["file"]["error"] > 0)
		{
			echo "Error: " . $_FILES["file"]["error"] . "<br>";
		}
		else
		{
			//echo "Upload: " . $_FILES["file"]["name"] . "<br>";
			//echo "Type: " . $_FILES["file"]["type"] . "<br>";
			//echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			//echo "Temp file: " . $_FILES["file"]["tmp_name"];
		}
		if (file_exists("$path" . $_FILES["file"]["name"]))
		{
		  echo $_FILES["file"]["name"] . " already exists. ";
		  echo "<br>";
		  echo "Please <a href='upload.php'>click here</a> to return to the upload page.";
		}
		else
		{
		  move_uploaded_file($_FILES["file"]["tmp_name"], "$path" . $_FILES["file"]["name"]);
		  echo "Your file was successfully uploaded to: " . "$path" . $_FILES["file"]["name"];
		  echo "<br>";
		  echo "Please <a href='upload.php'>click here</a> to return to the upload page.";
		}
	}
	else
	{
		echo "Error with user account";
	}
}
else
{
	die("You are not logged in. Please <a href='login.php'>click here</a> to log in.");
}
?>
