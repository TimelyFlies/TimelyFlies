function calculatePrice(price, childprice) {
    var adults = O('adult');
    adults = adults.options[adults.selectedIndex].value;
    var children = O('child');
    children = children.options[children.selectedIndex].value;
    var infants = O('infant');
    infants = infants.options[infants.selectedIndex].value;
    var adultTotal = adults * price;
    var childTotal = children * childprice;
    var total = adultTotal + childTotal;
    var priceText = "Adults:<br/>";
    priceText = priceText.concat(adults + " x $" + price + " = $" + adultTotal + "<br/>");
    priceText = priceText.concat("Children:<br/>");
    priceText = priceText.concat(children + " x $" + childprice + " = $" + childTotal + "<br/>");
    priceText = priceText.concat("Infants:<br/>");
    priceText = priceText.concat(infants + " x $0 = $0<br/><br/>");
    priceText = priceText.concat("Total = $" + total + "</br>");
    O('pricecalculation').innerHTML = priceText;
}

function validateFlight(form) {
    var fail = areCitiesValid(form.start.value, form.destination.value);
    fail += isDateValid(form.date.value);
    fail += isTimeValid(form.time.value);
    fail += arePricesValid(form.economy.value, form.business.value);
    if (fail == '') {
        return true;
    } else {
        alert(fail);
        return false;
    }
}

function areCitiesValid(start, destination) {
    var fail = '';
    if (/[^a-zA-Z\s\.]/.test(start) || /[^a-zA-Z\s\.]/.test(destination)) {
        fail = "City name may only contain spaces, periods, A-Z, and a-z.\n";
    }
    return fail;
}

function isDateValid(date) {
    var fail = '';
    if (!/20\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])/.test(date)) {
        fail = "Date must be in the form 'YYYY-MM-DD'.\n";
    }
    return fail;
}

function isTimeValid(time) {
    var fail = '';
    if (!/^([1-9]|1[0-2]):([0-5][0-9])\s([AP]M)$/.test(time)) {
        fail = "Time must be in the form 'HH:MM (A/P)M. Do not use a leading 0.\n";
    }
    return fail;
}

function arePricesValid(economy, business) {
    var fail = '';
    if (!/^\d+$/.test(economy) || !/^\d+$/.test(business)) {
        fail = "Price may only contain digits.\n";
    }
    return fail;
}

function validateQuery(form) {
    date = form.date.value;
    if (date == '') {
        return true;
    } else {
        var result = isDateValid(date);
        if (result == '') {
            return true;
        } else {
            alert(result);
            return false;
        }
    }
}