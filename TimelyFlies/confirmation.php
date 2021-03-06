<?php
require_once 'header.php';

if ($loggedin)
{
    if (isset($_POST['start']) && isset($_POST['destination']) && isset($_POST['date']) && isset($_POST['time'])
        && isset($_POST['class']) && isset($_POST['adult']) && isset($_POST['child']) && isset($_POST['infant']) && isset($_POST['price']))
    {
        $start = sanitizeString($_POST['start']);
        $destination = sanitizeString($_POST['destination']);
        $date = sanitizeString($_POST['date']);
        $time = sanitizeString($_POST['time']);
        $class = sanitizeString($_POST['class']);
        $adults = sanitizeString($_POST['adult']);
        $children = sanitizeString($_POST['child']);
        $infants = sanitizeString($_POST['infant']);
        $price = sanitizeString($_POST['price']);
        $childprice = .5*$price;
        $totalprice = $price*$adults + $childprice*$children;

        $query = "INSERT INTO user_flights VALUES('$user', '$start', '$destination', '$date', '$time', '$adults', '$children', '$infants', '$totalprice')";
        queryMysql($query);

        echo "<div class='header'><h1>Flight Confirmation</h1></div>";
        echo "<div class='main'>";
        echo "<table><tbody><tr><td><b>Starting City: </b></td><td>$start</td></tr>";
        echo "<tr><td><b>Destination: </b></td><td>$destination</td></tr>";
        echo "<tr><td><b>Date: </b></td><td>$date</td></tr>";
        echo "<tr><td><b>Time: </b></td><td>$time</td></tr>";
        echo "<tr><td><b>Class: </b></td><td>$class</td></tr>";
        echo "<tr><td><b>Adults: </b></td><td>$adults ($$price each)</td></tr>";
        echo "<tr><td><b>Children: </b></td><td>$children ($$childprice each)</td></tr>";
        echo "<tr><td><b>Infants: </b></td><td>$infants (fly free)</td></tr>";
        echo "<tr><td><b>Total Price: </b></td><td>$$totalprice</td></tr>";
        echo "</tbody></table></div>";
        echo "<div class = 'printbutton'>";
        echo "<style type='text/css' media='print'>
            .printbutton {
            visibility: hidden;
            display: none; }
            </style>" . "<input type='button' onClick='window.print()' value = 'Print this page'/>";
        echo "</div></body></html>";
    }
    else
    {
        die("Some flight information is missing. Please <a href='booking.php'>click here</a> to book your flight again.");
    }

    if (isset($_SESSION['start']) && isset($_SESSION['destination']) && isset($_SESSION['date']) && isset($_SESSION['time']) && isset($_SESSION['class']) && isset($_SESSION['flighttable'])) {
        unset($_SESSION['start']);
        unset($_SESSION['destination']);
        unset($_SESSION['flighttable']);
        unset($_SESSION['date']);
        unset($_SESSION['time']);
        unset($_SESSION['class']);
    }
}
else
{
    die("You are not logged in. Please <a href='login.php'>click here</a> to log in.");
}
?>
