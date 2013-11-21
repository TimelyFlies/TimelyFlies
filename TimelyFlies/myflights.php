<?php
require_once 'header.php';

if ($loggedin) {
    echo "<div id='header' class='header'><h2>My Flights</h2></div>";
    echo "<div id='flights' class='main'>";
    $query = "SELECT start, destination, date, time, adults, children, infants, price FROM user_flights WHERE username='$user'";
    $result = queryMysql($query);
    $rows = mysql_num_rows($result);
    if ($rows > 0) {
        echo "<table class='ftable'><thead><tr><th>Start</th><th>Destination</th><th>Date</th><th>Time</th><th>Adults</th><th>Children</th><th>Infants</th><th>Total Price</th></tr></thead><tbody>";
        for ($j = 0; $j < $rows; ++$j) {
            if ($j % 2 == 0) {
                $class = "";
            } else {
                $class = " class='alt'";
            }
            $row = mysql_fetch_row($result);
            echo "<tr$class><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td><td>$row[6]</td><td>$$row[7]</td></tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "You haven't booked any flights.";
    }
    echo "</div></body></html>";
} else {
    die("You are not logged in. Please <a href='login.php'>click here</a> to log in.");
}
?>