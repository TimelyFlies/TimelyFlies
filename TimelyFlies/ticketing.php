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
    } else if (isset($_SESSION['start']) && isset($_SESSION['destination']) && isset($_SESSION['date']) && isset($_SESSION['time']) && isset($_SESSION['class']) && isset($_SESSION['flighttable'])) {
        $start = sanitizeString($_SESSION['start']);
        $destination = sanitizeString($_SESSION['destination']);
        $flighttable = sanitizeString($_SESSION['flighttable']);
        $date = sanitizeString($_SESSION['date']);
        $time = sanitizeString($_SESSION['time']);
        $class = ucfirst(sanitizeString($_SESSION['class']));
    } else {
        die("Some flight information is missing. Please return to <a href='browse.php'>browsing</a> or <a href='booking.php'>booking</a> and select your flight again.");
    }

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
    die("You are not logged in. Please <a href='login.php'>click here</a> to log in.");
}
?>
