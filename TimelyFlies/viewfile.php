<?php
require_once 'header.php';
//echo "Testing page version 3";
$user = $_SESSION['user'];
$path = "/opt/bitnami/apache2/htdocs/TimelyFlies/" . $user;
$path = $path . "/";
$filename = $_GET['file'];
$filepath = $path . $filename;
//echo "$filename";
$extension = pathinfo($filepath, PATHINFO_EXTENSION);

if ($extension == 'pdf')
{
    header('Content-type: application/pdf');
    header('Content-Disposition: inline; filename='.basename($filepath));
    header('Content-Description: View PDF');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filepath));
    ob_clean();
    flush();
    readfile($filepath);
    exit;
}
else
{
    echo "<img src='david/$filename'>$filename</img>";
}
?>
