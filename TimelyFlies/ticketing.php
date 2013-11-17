<?php
require_once 'header.php';

if ($loggedin) {
    if (isset($_POST['start']) && isset($_POST['destination']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['class']) && isset($_POST['flighttable'])) {
        $start = sanitizeString($_POST['start']);
        $destination = sanitizeString($_POST['destination']);
        $flighttable = sanitizeString($_POST['flighttable']);
        $date = sanitizeString($_POST['date']);
        $time = sanitizeString($_POST['time']);
        $class = ucfirst(sanitizeString($_POST['class']));

        echo "<div id='container'><div id='header' class='header'><h1>Ticketing</h1></div>";
        echo "<div id='menu' class='menubar'>";
        echo "<form name='tickets' action='confirmation.php' method='post'>";

        $result = queryMysql("SELECT start, destination, date, time, $class FROM $flighttable WHERE start='$start' AND destination='$destination' AND date='$date' AND time='$time'");
        $rows = mysql_num_rows($result);
        if ($rows > 0) {
            $row = mysql_fetch_row($result);
            $price = $row[4];
            $childprice = $price / 2;
        } else {
            $price = 0;
            $childprice = 0;
        }

        echo "<br/>Adult (12+):<br/>";
        echo "<select name='adult' id='adult' size='1' onclick='calculatePrice($price, $childprice)'>";
        for ($j = 0; $j < 10; ++$j) {
            echo "<option value='$j'>$j</option>";
        }
        echo "</select><br/><br/>";

        echo "Child (2-11):<br/>";
        echo "<select name='child' id='child' size='1' onclick='calculatePrice($price, $childprice)'>";
        for ($j = 0; $j < 10; ++$j) {
            echo "<option value='$j'>$j</option>";
        }
        echo "</select><br/><br/>";

        echo "Infant (0-1):<br/>";
        echo "<select name='infant' id='infant' size='1' onclick='calculatePrice($price, $childprice)'>";
        for ($j = 0; $j < 10; ++$j) {
            echo "<option value='$j'>$j</option>";
        }
        echo "</select></br></br>";

        echo "<span name='pricecalculation' id='pricecalculation'></span>";
        echo "<input type='hidden' name='start' value='$start'/>";
        echo "<input type='hidden' name='destination' value='$destination'/>";
        echo "<input type='hidden' name='date' value='$date'/>";
        echo "<input type='hidden' name='time' value='$time'/>";
        echo "<input type='hidden' name='class' value='$class'/>";
        echo "<input type='hidden' name='price' value='$price'/>";

        echo "<input type='submit' value='Book Flight'/>";

        echo "</form>";
        echo "</div>";

        echo "<div id='flights' class='main'>";
        if ($rows > 0) {
            echo "<table><thead><th>Start</th><th>Destination</th><th>Date</th><th>Time</th><th>Class</th><th>Price</th></thead><tbody>";
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
<?php
require_once 'header.php';

if ($loggedin) {
    date_default_timezone_set('America/Phoenix');

    echo "<div id='container'><div id='header' class='header'><h1>Book Flights</h1></div>";
    echo "<div id='menu' class='menubar'>";
    echo "<form name='book' action='booking.php' method='post'>";
    echo "<br/>Domestic/International:<br/>";
    echo "<label><input type='radio' name='flighttable' value='domestic_flights' onclick='getStartingCities(this);getDestinations(this)'/>Domestic</label><br/>";
    echo "<label><input type='radio' name='flighttable' value='international_flights' onclick='getStartingCities(this);getDestinations(this)'/>International</label><br/><br/>";
    echo "Starting City:<br/>";
    echo "<select name='start' id='start' size='1'>";
    echo "</select><br/><br/>";
    echo "Destination:<br/>";
    echo "<select name='destination' id='destination' size='1'>";
    echo "</select><br/><br/>";

    $today = getdate();
    $year = $today['year'];
    $month = $today['mon'];
    $day = $today['mday'];
    if ($day < 10) {
        $day = "0$day";
    }
    $date = "$year-$month-$day";

    $dateError = "";
    if (isset($_POST['date'])) {
        $dateError = isDateValid($_POST['date']);
    }

    $errors = "";
    $errors .= $dateError;

    echo "Date:<br/>";
    echo "<input type='text' maxlength='10' size='10' value='$date' name='date' id='date' onBlur='checkDate(this)'/><br/>";
    echo "<span id='info'></span>";
    echo "<br/>";
    echo "Class:</br>";
    echo "<label><input type='radio' name='class' value='economy' checked/>Economy</label><br/>";
    echo "<label><input type='radio' name='class' value='business'/>Business</label><br/><br/>";
    echo "<input type='submit' value='Browse Flights'/>";
    echo "</form>";
    echo "</div>";

    echo "<div id='flights' class='main'>";
    if (isset($_POST['start']) && $errors == "") {
        $start = sanitizeString($_POST['start']);
        $flighttable = sanitizeString($_POST['flighttable']);
        $class = sanitizeString($_POST['class']);
        $destination = sanitizeString($_POST['destination']);
        $date = sanitizeString($_POST['date']);
        $result = queryMysql("SELECT start, destination, date, time, $class FROM $flighttable WHERE start='$start' " .
            "AND destination='$destination' AND date='$date'");
        $rows = mysql_num_rows($result);
        if ($rows > 0) {
            echo "<table><thead><th>Start</th><th>Destination</th><th>Date</th><th>Time</th><th>Price</th></thead><tbody>";
            for ($j = 0; $j < $rows; ++$j) {
                $row = mysql_fetch_row($result);
                echo "<tr><form name='bookflight' action='ticketing.php' method='POST'>" .
                "<input type='hidden' name='start' value='$start'/>" .
                "<input type='hidden' name='flighttable' value='$flighttable'/>" .
                "<input type='hidden' name='class' value='$class'/>" .
                "<input type='hidden' name='destination' value='$destination'/>" .
                "<input type='hidden' name='date' value='$date'/>" .
                "<input type='hidden' name='time' value='$row[3]'/>" .
                "<td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$$row[4]</td>" .
                "<td><input type='submit' value='Tickets'/></td></form></tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "No flights found.";
        }
    } else if ($errors != ""){
        echo $errors;
    } else {
        echo "Please enter your search information to browse flights.";
    }
    echo "</div></div></body></html>";
} else {
    die("You are not logged in. Please <a href='login.php'>click here</a> to log in.");
}
?>}
?>
