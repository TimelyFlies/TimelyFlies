function getStartingCities(flighttable) {
    if (flighttable.value == '') {
        O('start').innerHTML = '';
        return;
    } else {
        var params = 'flighttable=' + flighttable.value;
        request = new ajaxRequest();
        request.open("POST", "startingcities.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //request.setRequestHeader("Content-length", params.length);
        //request.setRequestHeader("Connection", "close");

        request.onreadystatechange = function() {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    if (this.responseText != null) {
                        O('start').innerHTML = this.responseText;
                    }
                }
            }
        };
        request.send(params);
    }
}

function getDestinations(flighttable) {
    if (flighttable.value == '') {
        O('destination').innerHTML = '';
        return;
    } else {
        var params = 'flighttable=' + flighttable.value;
        request = new ajaxRequest();
        request.open("POST", "destinations.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //request.setRequestHeader("Content-length", params.length);
        //request.setRequestHeader("Connection", "close");

        request.onreadystatechange = function() {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    if (this.responseText != null) {
                        O('destination').innerHTML = this.responseText;
                    }
                }
            }
        };
        request.send(params);
    }
}

function checkDate(date) {
    if (date.value == '') {
        O('info').innerHTML = '';
        return;
    } else {
        var params = 'date=' + date.value;
        request = new ajaxRequest();
        request.open("POST", "checkdate.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.setRequestHeader("Content-length", params.length);
        request.setRequestHeader("Connection", "close");

        request.onreadystatechange = function() {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    if (this.responseText != null) {
                        O('info').innerHTML = this.responseText;
                    }
                }
            }
        };
        request.send(params);
    }
}

function calculatePrice() {

}

function ajaxRequest() {
    try {
        var request = new XMLHttpRequest();
    } catch (e1) {
        try {
            request = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e2) {
            try {
                request = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e3) {
                request = false;
            }
        }
    }
    return request;
}