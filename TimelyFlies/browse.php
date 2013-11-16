<?php
require_once 'header.php';

echo "<script src='ajax.js'></script>";

echo "<title>$appname $userstr</title></head><body><div id='container'><div id='header' class='header'><h1>Browse Flights</h1></div>";
echo "<div id='menu' class='menubar'>";
echo "<form name='browse' action='browse.php' method='post'>";
echo "<br/>Domestic/International:<br/>";
echo "<label><input type='radio' name='flighttable' value='domestic_flights' onclick='getStartingCities(this)'/>Domestic</label><br/>";
echo "<label><input type='radio' name='flighttable' value='international_flights' onclick='getStartingCities(this)'/>International</label><br/><br/>";
echo "Starting City:<br/>";
echo "<select name='start' id='start' size='1'>";
echo "</select><br/><br/>";
echo "Class:</br>";
echo "<label><input type='radio' name='class' value='economy' checked/>Economy</label><br/>";
echo "<label><input type='radio' name='class' value='business'/>Business</label><br/><br/>";
echo "<input type='submit' value='Browse Flights'/>";
echo "</form>";
echo "</div>";

echo "<div id='flights' class='main'>";
if (isset($_POST['start'])) {
    $start = sanitizeString($_POST['start']);
    $flighttable = sanitizeString($_POST['flighttable']);
    $class = sanitizeString($_POST['class']);
    $result = queryMysql("SELECT start, destination, date, time, $class FROM $flighttable WHERE start='$start'");
    $rows = mysql_num_rows($result);
    if ($rows > 0) {
        echo "<table><thead><th>Start</th><th>Destination</th><th>Date</th><th>Time</th><th>Price</th></thead><tbody>";
        for ($j = 0; $j < $rows; ++$j) {
            $row = mysql_fetch_row($result);
            echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$$row[4]</td></tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "No flights found.";
    }
} else {
    echo "Please enter a starting city.";
}
echo "</div></div></body></html>";
?>