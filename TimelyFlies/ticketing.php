<?php
require_once 'header.php';

if ($loggedin) {
    if (isset($_GET['start']) && isset($_GET['destination']) && isset($_GET['date']) && isset($_GET['time']) && isset($_GET['class']) && isset($_GET['flighttable'])) {
        $start = sanitizeString($_GET['start']);
        $destination = sanitizeString($_GET['destination']);
        $flighttable = sanitizeString($_GET['flighttable']);
        $date = sanitizeString($_GET['date']);
        $time = sanitizeString($_GET['time']);
        $class = ucfirst(sanitizeString($_GET['class']));

        echo "<title>$appname $userstr</title></head><body><div id='container'><div id='header' style='background-color:#FFA500;'><h1 style='margin-bottom:0;'>Ticketing</h1></div>";
        echo "<div id='menu' style='background-color:#FFD700;float:left;'>";
        echo "<form name='tickets' action='confirmation.php' method='post'>";

        echo "<br/>Adult (12+):<br/>";
        echo "<select name='adult' size='1' onclick='calculatePrice()'>";
        for ($j = 0; $j < 10; ++$j) {
            echo "<option value='$j'>$j</option>";
        }
        echo "</select><br/><br/>";

        echo "Child (2-11):<br/>";
        echo "<select name='child' size='1'>";
        for ($j = 0; $j < 10; ++$j) {
            echo "<option value='$j'>$j</option>";
        }
        echo "</select><br/><br/>";

        echo "Infant (0-1):<br/>";
        echo "<select name='adult' size='1'>";
        for ($j = 0; $j < 10; ++$j) {
            echo "<option value='$j'>$j</option>";
        }
        echo "</select></br></br>";

        echo "</form>";
        echo "</div>";

        echo "<div id='flights' style='background-color:#EEE;'>";
        $result = queryMysql("SELECT start, destination, date, time, $class FROM $flighttable WHERE start='$start' AND destination='$destination' AND date='$date' AND time='$time'");
        $rows = mysql_num_rows($result);
        if ($rows > 0) {
            echo "<table><thead><th>Start</th><th>Destination</th><th>Date</th><th>Time</th><th>Class</th><th>Price</th></thead><tbody>";
            $row = mysql_fetch_row($result);
            $price = $row[4];
            echo "<tr><td>$start</td><td>$destination</td><td>$date</td><td>$time</td><td>$class</td><td>$$price<td/></tr>";
            echo "</tbody></table>";
        } else {
            echo "That flight wasn't found. Please return to the <a href='booking.php'>booking page</a> and select your flight again.";
        }
        echo "</div></div></body></html>";
    } else {
        die("Some flight information is missing. Please return to the <a href='booking.php'>booking page</a> and select your flight again.");
    }
} else {
    die("You must be logged in to view this page.");
}
?>