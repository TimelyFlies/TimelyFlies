<?php
    require_once 'header.php';

    if ($is_admin) {
        $errors = array('', '', '', '', '', '');
        $start = $destination = $date = $time = $economy = $business = $resultmsg = "";
        if (isset($_POST['start'])) {
            $start = trim(sanitizeString($_POST['start']));
            $destination = trim(sanitizeString($_POST['destination']));
            $date = trim(sanitizeString($_POST['date']));
            $time = trim(sanitizeString($_POST['time']));
            $economy = trim(sanitizeString($_POST['economy']));
            $business = trim(sanitizeString($_POST['business']));
            $flighttable = sanitizeString($_POST['flighttable']);
            $errors = validateInputs($start, $destination, $date, $time, $economy, $business);

            if ($errors[0] == "" && $errors[1] == "" && $errors[2] == "" && $errors[3] == "" && $errors[4] == "" && $errors[5] == "") {
                $query = "INSERT INTO $flighttable VALUES('$start', '$destination', '$date', '$time', '$economy', '$business')";
                queryMysql($query);
                $start = $destination = $date = $time = $economy = $business = "";
                $resultmsg = "Flight added successfully.";
            }
        }

        echo "<div id='container'><div id='header' class='header'><h1>Add Flight</h1></div><pre>";
        echo "<form name='addflight' action='addflights.php' method='post' onSubmit='return validateFlight(this)'>";
        echo "<label>      Domestic <input type='radio' name='flighttable' value='domestic_flights' checked/></label><br/>";
        echo "<label> International <input type='radio' name='flighttable' value='international_flights'/></label><br/><br/>";
        echo "<label> Starting City <input type='text' maxlength='32' name='start' onBlur='checkCity(this, 0)' value='$start' required/></label><br/>";
        echo "               <span id='startinfo'><font color='red'>$errors[0]</font></span><br/>";
        echo "<label>   Destination <input type='text' maxlength='32' name='destination' onBlur='checkCity(this, 1)' value='$destination' required/></label><br/>";
        echo "               <span id='destinfo'><font color='red'>$errors[1]</font></span><br/>";
        echo "<label>          Date <input type='text' maxlength='10' name='date' onBlur='checkDate(this)' value='$date' required/></label><br/>";
        echo "               <font color='red'><span id='info'>$errors[2]</span></font><br/>";
        echo "<label>          Time <input type='text' maxlength='8' name='time' onBlur='checkTime(this)' value='$time' required/></label><br/>";
        echo "               <span id='timeinfo'><font color='red'>$errors[3]</font></span><br/>";
        echo "<label> Economy Price <input type='text' name='economy' onBlur='checkPrice(this, 0)' value='$economy' required/></label><br/>";
        echo "               <span id='economyinfo'><font color='red'>$errors[4]</font></span><br/>";
        echo "<label>Business Price <input type='text' name='business' onBlur='checkPrice(this, 1)' value='$business' required/></label><br/>";
        echo "               <span id='businessinfo'><font color='red'>$errors[5]</font></span><br/>";
        echo "               <input type='submit' value='Add Flight'/><br/>";
        echo "               <span>$resultmsg</span></pre>";
        echo "</form>";
        echo "</div></body></html>";
    } else {
        die("You are not authorized to view this page.");
    }
?>