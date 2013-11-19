<?php
require_once 'header.php';
echo "Testing page version 3";
$path = "/opt/bitnami/apache2/htdocs/TimelyFlies/";
$filename = $path . $_GET['file'];
echo "$filename";

if (file_exists($filename))
{
  echo "File exists";
  header('Content-Description: View PDF');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($file));
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
  echo "file does not exist";
}
?>
