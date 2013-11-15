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
        //request.setRequestHeader("Content-length", params.length);
        //request.setRequestHeader("Connection", "close");

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

function checkTime(time) {
    if (time.value == '') {
        O('timeinfo').innerHTML = '';
        return;
    } else {
        var params = 'time=' + time.value;
        request = new ajaxRequest();
        request.open("POST", "checktime.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //request.setRequestHeader("Content-length", params.length);
        //request.setRequestHeader("Connection", "close");

        request.onreadystatechange = function() {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    if (this.responseText != null) {
                        O('timeinfo').innerHTML = this.responseText;
                    }
                }
            }
        };
        request.send(params);
    }
}

function checkPrice(price, fclass) {
    if (price.value == '') {
        if (fclass == 0) {
            O('economyinfo').innerHTML = '';
        } else {
            O('businessinfo').innerHTML = '';
        }
        return;
    } else {
        var params = 'price=' + price.value;
        request = new ajaxRequest();
        request.open("POST", "checkprice.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //request.setRequestHeader("Content-length", params.length);
        //request.setRequestHeader("Connection", "close");

        request.onreadystatechange = function() {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    if (this.responseText != null) {
                        if (fclass == 0) {
                            O('economyinfo').innerHTML = this.responseText;
                        } else {
                            O('businessinfo').innerHTML = this.responseText;
                        }
                    }
                }
            }
        };
        request.send(params);
    }
}

function checkCity(city, cclass) {
    if (city.value == '') {
        if (cclass == 0) {
            O('startinfo').innerHTML = '';
        } else {
            O('destinfo').innerHTML = '';
        }
        return;
    } else {
        var params = 'city=' + city.value;
        request = new ajaxRequest();
        request.open("POST", "checkcity.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //request.setRequestHeader("Content-length", params.length);
        //request.setRequestHeader("Connection", "close");

        request.onreadystatechange = function() {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    if (this.responseText != null) {
                        if (cclass == 0) {
                            O('startinfo').innerHTML = this.responseText;
                        } else {
                            O('destinfo').innerHTML = this.responseText;
                        }
                    }
                }
            }
        };
        request.send(params);
    }
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