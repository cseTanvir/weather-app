<?php
//debug turned off
error_reporting(0);
//initializing weather result
$weather = "";
//initialising error
$error = "";


//if search field is not empty
if ($_GET['city']) {
    //calling api
    $urlContents = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($_GET['city']) . "&appid=e80fb758df7b068d202d79efeaeb81c5");
//parsing json response in array        
    $weatherArray = json_decode($urlContents, true);
//processing array to get weather results     

    if ($weatherArray['cod'] == 200) {

        $weather = 'The weather in <span class="text-uppercase font-weight-bold">' . $_GET['city'] . '</span> is currently<br>' . '<img src="https://openweathermap.org/img/wn/' . $weatherArray['weather'][0]['icon'] . '@2x.png" alt="' . $weatherArray['weather'][0]['description'] . '">' . ' <span class="text-uppercase font-weight-bold">' . $weatherArray['weather'][0]['description'] . "</span>. <br> ";

        $tempInCelcius = floatval($weatherArray['main']['temp'] - 273);

        $weather .= ' The temperature is <span class="text-uppercase font-weight-bold">' . $tempInCelcius . '&deg;C</span> and the wind speed is <br> <span class="font-weight-bold">' . $weatherArray['wind']['speed'] . "m/s.</span>";

    } //if city is not found then report error
    else {

        $error = "Could not find city - please try again.";

    }

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- Title of the webpage -->
    <title>Weather API demonstration</title>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <style>

        html {
            background: url(background.jpeg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        body {

            background: none;

        }

        .container {

            text-align: center;
            margin-top: 100px;
            width: 450px;

        }

        input {

            margin: 20px 0;

        }

        #myLocation{

            margin-top: 20px ;

        }
        #weather {

            margin-top: 15px;

        }

    </style>

</head>
<body>

<div class="container">

    <h1>What's The Weather?</h1>
    <h2>Enter the name of a city.</h2>

    <form>
        <!-- City Input -->
        <div class="form-group ">
            <div class="input-group">
                <input type="text" class="form-control col-10 name="city" id="city" placeholder="Eg. Dhaka, Rajshahi"
                       value="<?php echo $_GET['city']; ?>">
                <button class="btn btn-xs btn-info col-2" id="myLocation"><i class="fa-solid fa-location-crosshairs"></i></button>
            </div>
        </div>
        <!-- Submission Button -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <div id="weather"><?php

        // Showing Weather  from API Result
        if ($weather) {
            // echo '<div > <img src="https://openweathermap.org/img/wn/'.$weatherArray['weather'][0]['icon'].'.png"></div>';


            echo '<div class="alert alert-info " role="alert">
  ' . $weather . '
</div>';

        } // Showing Error if City is not found
        else if ($error) {

            echo '<div class="alert alert-danger" role="alert">
  ' . $error . '
</div>';

        }

        ?></div>
</div>

<!-- jQuery first, then Bootstrap JS. -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>
</html>