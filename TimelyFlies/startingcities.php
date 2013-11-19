<?php
require_once 'functions.php';

if (isset($_POST['flighttable'])) {
    $flighttable = sanitizeString($_POST['flighttable']);
    $result = queryMysql("SELECT DISTINCT start FROM $flighttable ORDER BY start");

    if ($result) {
        $rows = mysql_num_rows($result);
        echo "<option value='Any'>Any</option>";
        for ($i = 0; $i < $rows; ++$i) {
            $row = mysql_fetch_row($result);
            echo "<option value='$row[0]'>$row[0]</option>";
        }
    } else {
        echo "<option>None</option>";
    }
}
?>