<?php
require_once 'header.php';
echo "Testing page version 3";
$path = "/opt/bitnami/apache2/htdocs/TimelyFlies/";
$filename = $path . $_GET['file'];
echo "$filename";
$extension = pathinfo($filename, PATHINFO_EXTENSION);


if ($extension == 'pdf')
{
    header('Content-type: application/pdf');
    header('Content-Disposition: inline; filename='.basename($filename));
    header('Content-Description: View PDF');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename));
    ob_clean();
    flush();
    readfile($filename);
    exit;
}
else
{
  echo "<img src='$filename'>";
}
?>