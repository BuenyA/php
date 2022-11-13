function linkToAnmeldung() {
    window.location = "../account/anmeldung.php";
}

function loadDanke() {
    window.location = "./vielenDankAngebot.php";
}

function reloadWindow() {
    window.location = "../index.php";
}

function reloadWindowMeinAccount() {
    window.location = "?page=MeinKonto";
}

function calculateTime(getDateTime, counter = '') {
    var countDownDate = new Date(getDateTime).getTime();
    // Update the count down every 1 second
    var counterID = "counter" + counter;
    var x = setInterval(function () {
        var now = new Date().getTime();
        // Find the distance between now an the count down date
        var distance = countDownDate - now;
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        // Output the result in an element with id="counter"11
        document.getElementById(counterID).innerHTML = days + "d " + hours + "h " +
            minutes + "m " + seconds + "s ";
        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById(counterID).innerHTML = "Abgelaufen";
        }
    }, 100);
}

function auswaehlen(s){
    wert=s.options[s.selectedIndex].value;
    if (wert!=0) {
         location.href='index.php?Marke=' + wert;
    }
    else {
        location.href='index.php';
    }
} 