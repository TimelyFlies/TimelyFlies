<?php
    require_once 'header.php';

    if ($is_admin) {
        if (isset($_POST['start'])) {
            $start = trim(sanitizeString($_POST['start']));
            $destination = trim(sanitizeString($_POST['destination']));
            $date = trim(sanitizeString($_POST['date']));
            $time = trim(sanitizeString($_POST['time']));
            $economy = trim(sanitizeString($_POST['economy']));
            $business = trim(sanitizeString($_POST['business']));
            $flighttable = sanitizeString($_POST['flighttable']);
            $query = "INSERT INTO $flighttable VALUES('$start', '$destination', '$date', '$time', '$economy', '$business')";
            queryMysql($query);
        }

        echo "<script src='ajax.js'></script>";
        echo "<script src='functions.js'></script>";
        echo "</head><body><div id='container'><div id='header' class='header'><h1>Add Flight</h1></div><pre>";
        echo "<form name='addflight' action='addflights.php' method='post' onSubmit='return validateFlight(this)'>";
        echo "<label>      Domestic <input type='radio' name='flighttable' value='domestic_flights' checked/></label><br/>";
        echo "<label> International <input type='radio' name='flighttable' value='international_flights'/></label><br/><br/>";
        echo "<label> Starting City <input type='text' maxlength='32' name='start' onBlur='checkCity(this, 0)' required/></label><br/>";
        echo "               <span id='startinfo'></span><br/>";
        echo "<label>   Destination <input type='text' maxlength='32' name='destination' onBlur='checkCity(this, 1)' required/></label><br/>";
        echo "               <span id='destinfo'></span><br/>";
        echo "<label>          Date <input type='text' maxlength='10' name='date' onBlur='checkDate(this)' required/></label><br/>";
        echo "               <span id='info'></span><br/>";
        echo "<label>          Time <input type='text' maxlength='8' name='time' onBlur='checkTime(this)' required/></label><br/>";
        echo "               <span id='timeinfo'></span><br/>";
        echo "<label> Economy Price <input type='text' name='economy' onBlur='checkPrice(this, 0)' required/></label><br/>";
        echo "               <span id='economyinfo'></span><br/>";
        echo "<label>Business Price <input type='text' name='business' onBlur='checkPrice(this, 1)' required/></label><br/>";
        echo "               <span id='businessinfo'></span><br/>";
        echo "               <input type='submit' value='Add Flight'/></pre>";
        echo "</form>";
    } else {
        die("You are not authorized to view this page.");
    }
?>