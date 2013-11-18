<?php
require_once 'header.php';

echo "<div id='container'><div id='header' class='header'><h2>Browse Flights</h2></div>";
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
            $date = $row[2];
            $destination = $row[1];
            $time = $row[3];
            echo "<tr><form name='bookflight' action='ticketing.php' method='POST'>" .
                "<input type='hidden' name='start' value='$start'/>" .
                "<input type='hidden' name='flighttable' value='$flighttable'/>" .
                "<input type='hidden' name='class' value='$class'/>" .
                "<input type='hidden' name='destination' value='$destination'/>" .
                "<input type='hidden' name='date' value='$date'/>" .
                "<input type='hidden' name='time' value='$time'/>" .
                "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$$row[4]</td>" .
                "<td><input type='submit' value='Tickets'/></td></form></tr>";
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
