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
        //echo "<tr><td><b>Price: </b></td><td>$$price</td></tr>";
        echo "</tbody></table></div></body></html>";
    }
    else
    {
        die("Some flight information is missing. Please <a href='booking.php'>click here</a> to book your flight again.");
    }
}
else
{
    die("You are not logged in. Please <a href='login.php'>click here</a> to log in.");
}
?>
