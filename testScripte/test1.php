<?php

/* //A: RECORDS TODAY'S Date And Time
$today = time();

//B: RECORDS Date And Time OF YOUR EVENT
$event = mktime(0,0,0,12,25,2022);

//C: COMPUTES THE DAYS UNTIL THE EVENT.
$countdown = round(($event - $today)/86400);

//D: DISPLAYS COUNTDOWN UNTIL EVENT
echo "$countdown days until Christmas"; */


$wedding = strtotime("2022-11-01 12:00:00+0400"); // or whenever the wedding is
$secondsLeft = $wedding - time();
$days = floor($secondsLeft / (60*60*24)); // here the brackets
$hours = floor(($secondsLeft - ($days*60*60*24)) / (60*60)); // and here too
echo "$days days and $hours hours left";

?>