<?php
require_once 'header.php';

$date = $dateError = "";
if (isset($_POST['date'])) {
    $date = $_POST['date'];
    $dateError = isDateValid($_POST['date']);
}

$errors = "";
$errors .= $dateError;

echo "<noscript><style type='text/css'>#container {display:none;}</style>";
echo "<div>You don't have JavaScript enabled. Please enable JavaScript in your browser or switch to a browser that supports it.</div></noscript>";
echo "<div id='container'><div id='header' class='header'><h2>Browse Flights</h2></div>";
echo "<div id='menu' class='menubar'>";
echo "<form name='browse' action='browse.php' onsubmit='return validateQuery(this)' method='post'>";
echo "<b>Refine Results</b><br/><br/>";
echo "Domestic/International:<br/>";
echo "<label><input type='radio' name='flighttable' value='domestic_flights' onclick='getStartingCities(this);getDestinations(this);'/>Domestic</label><br/>";
echo "<label><input type='radio' name='flighttable' value='international_flights' onclick='getStartingCities(this);getDestinations(this);'/>International</label><br/><br/>";
echo "Starting City:<br/>";
echo "<select name='start' id='start' size='1'>";
echo "</select><br/><br/>";
echo "Destination:<br/>";
echo "<select name='destination' id='destination' size='1'>";
echo "</select><br/><br/>";
echo "Date:<br/>";
echo "<input type='text' maxlength='10' size='10' name='date' id='date' onBlur='checkDate(this)'/><br/>";
echo "<font size='2' color='yellow'><span id='info'></span></font><br/>";
echo "Class:<br/>";
echo "<label><input type='radio' name='class' value='economy' checked/>Economy</label><br/>";
echo "<label><input type='radio' name='class' value='business'/>Business</label><br/><br/>";
echo "<input type='submit' value='Browse Flights'/>";
echo "</form>";
echo "</div>";

echo "<div id='flights' class='main'>";
if ($errors == "") {
    $start = $destination = $flighttable = $class = $date = "";

    if (isset($_POST['start'])) {
        $start = sanitizeString($_POST['start']);
    }

    if (isset($_POST['destination'])) {
        $destination = sanitizeString($_POST['destination']);
    }

    if (isset($_POST['flighttable'])) {
        $flighttable = sanitizeString($_POST['flighttable']);
    } else {
        $flighttable = "domestic_flights";
    }

    if (isset($_POST['class'])){
        $class = sanitizeString($_POST['class']);
    } else {
        $class = "economy";
    }

    if (isset($_POST['date'])) {
        $date = sanitizeString($_POST['date']);
    }

    $fromClause = $whereClause = $orderBy = "";

    $fromClause = "FROM $flighttable";

    $startSpecified = ($start != "Any" && $start != "");
    $destinationSpecified = ($destination != "Any" && $destination != "");
    $dateSpecified = ($date != "");

    if ($startSpecified && $destinationSpecified && $dateSpecified) {
        // start, destination, and date have been specified
        $whereClause = "WHERE start='$start' AND destination='$destination' AND date='$date' ";
        $orderBy = "ORDER BY time, $class";
    } else if ($startSpecified && $destinationSpecified && !$dateSpecified) {
        // start and destination have been specified
        $whereClause = "WHERE start='$start' AND destination='$destination' ";
        $orderBy = "ORDER BY date";
    } else if ($startSpecified && !$destinationSpecified && $dateSpecified) {
        // start and date have been specified
        $whereClause = "WHERE start='$start' AND $date='$date' ";
        $orderBy = "ORDER BY destination";
    } else if ($startSpecified && !$destinationSpecified && !$dateSpecified) {
        // start has been specified
        $whereClause = "WHERE start='$start' ";
        $orderBy = "ORDER BY destination, date";
    } else if (!$startSpecified && $destinationSpecified && $dateSpecified) {
        // destination and date have been specified
        $whereClause = "WHERE destination='$destination' AND date='$date' ";
        $orderBy = "ORDER BY start";
    } else if (!$startSpecified && $destinationSpecified && !$dateSpecified) {
        // destination has been specified
        $whereClause = "WHERE destination='$destination' ";
        $orderBy = "ORDER BY start, date";
    } else if (!$startSpecified && !$destinationSpecified && $dateSpecified) {
        // date has been specified
        $whereClause = "WHERE date='$date' ";
        $orderBy = "ORDER BY start, destination";
    } else {
        // nothing has been specified
        $orderBy = "ORDER BY start, destination, date";
    }

    $result = queryMysql("SELECT start, destination, date, time, $class $fromClause $whereClause $orderBy");

    $rows = mysql_num_rows($result);
    if ($rows > 0) {
        echo "<table class='ftable'><thead><tr><th>Start</th><th>Destination</th><th>Date</th><th>Time</th><th>Price</th><th>Book</th></tr></thead><tbody>";
        for ($j = 0; $j < $rows; ++$j) {
            $row = mysql_fetch_row($result);
            $start = $row[0];
            $destination = $row[1];
            $date = $row[2];
            $time = $row[3];
            if ($j % 2 == 0) {
                $tableclass = "";
            } else {
                $tableclass = " class='alt'";
            }

            if ($loggedin) {
                echo "<tr><form name='bookflight' action='ticketing.php' method='POST'>";
            } else {
                echo "<tr><form name='bookflight' action='login.php' method='POST'>";
            }
            echo "<input type='hidden' name='start' value='$start'/>" .
                "<input type='hidden' name='flighttable' value='$flighttable'/>" .
                "<input type='hidden' name='class' value='$class'/>" .
                "<input type='hidden' name='destination' value='$destination'/>" .
                "<input type='hidden' name='date' value='$date'/>" .
                "<input type='hidden' name='time' value='$time'/>" .
                "<tr$tableclass><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$$row[4]</td>" .
                "<td><input type='submit' value='Tickets'/></td></form></tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "No flights found.";
    }
} else {
    echo $errors;
}
echo "</div></div></body></html>";
?>
