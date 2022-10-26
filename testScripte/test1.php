<?php

/* //A: RECORDS TODAY'S Date And Time
$today = time();

//B: RECORDS Date And Time OF YOUR EVENT
$event = mktime(0,0,0,12,25,2022);

//C: COMPUTES THE DAYS UNTIL THE EVENT.
$countdown = round(($event - $today)/86400);

//D: DISPLAYS COUNTDOWN UNTIL EVENT
echo "$countdown days until Christmas"; */

$waiting_day = strtotime("2022-11-01 12:00:00+0400");
$time_left = $waiting_day - time();

$days = floor($time_left / (60*60*24));
$time_left %= (60 * 60 * 24);
$hours = floor($time_left / (60 * 60));
$time_left %= (60 * 60);
$min = floor($time_left / 60);
$time_left %= 60;
$sec = $time_left;

echo "Remaing time: $days days and $hours hours and $min min and $sec sec left";
?>