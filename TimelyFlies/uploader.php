<?php
require_once 'header.php';
echo "Test page for uploader";
$path = "/opt/bitnami/apache2/htdocs/TimelyFlies";
if ($loggedin)
{
	if (isset($_SESSION['user']))
	{
        $user = sanitizeString($_SESSION['user']);
        echo "User: $user";
        $path .= "/";
        $path .= $user;
        $path .= "/"
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
		if (file_exists("$path" . $_FILES["file"]["name"]))
		{
		  echo $_FILES["file"]["name"] . " already exists. ";
		}
		else
		{
		  move_uploaded_file($_FILES["file"]["tmp_name"], "$path" . $_FILES["file"]["name"]);
		  echo "<br> </br>";
		  echo "Stored in: " . "$path" . $_FILES["file"]["name"];
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
