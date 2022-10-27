<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Creating Dynamic Countdown In PHP, JavaScript- Nicesnippets.com</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Poppins fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <style type="text/css">
        body{
            font-family: 'Poppins', sans-serif;
        }
        #counter {
            width: 410px;
            background: #ff190b;
            box-shadow: 0px 2px 9px 0px black;
        }
    </style>    
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 mt-40">
                <div class="card" style="height: 400px;">
                    <div class="card-header text-white text-center bg-success">
                        <h2>Creating Dynamic Countdown In PHP, JavaScript- Nicesnippets.com</h2>     
                    </div>
                    <div class="card-body pt-5">
                        <?php
                        for ($i=0; $i < 2; $i++) { 
                            echo '<h1 id="counter" class="text-center mt-5 m-auto p-3 text-white"></h1>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        <?php 
        //    $dateTime = strtotime('April 11, 2022 19:00:00');
           $dateTime = strtotime("2022-10-30 12:00:00+0200");
           $getDateTime = date("F d, Y H:i:s", $dateTime);
        ?>
        var countDownDate = new Date("<?php echo "$getDateTime"; ?>").getTime();
        // Update the count down every 1 second
        var x = setInterval(function() {
            var now = new Date().getTime();
            // Find the distance between now an the count down date
            var distance = countDownDate - now;
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            // Output the result in an element with id="counter"11
            document.getElementById("counter").innerHTML = days + "d " + hours + "h " +
            minutes + "m " + seconds + "s ";
            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("counter").innerHTML = "Abgelaufen";
            }
        }, 1000);
    </script>
</body>
</html> 