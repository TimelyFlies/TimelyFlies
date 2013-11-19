<?php
// The location of the PDF file on the server.
$filename = "/path/to/the/file.pdf";

// Let the browser know that a PDF file is coming.
header("Content-type: application/pdf");
header("Content-Length: " . filesize($filename));

// Send the file to the browser.
readfile($filename);
?>
