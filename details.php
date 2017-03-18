<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>1stAmendment - Peaceful Protests</title>

        <!-- Bootstrap core CSS -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="bootstrap/css/cover.css" rel="stylesheet">

    </head>

    <body>

        <div class="site-wrapper">

            <div class="site-wrapper-inner">

                <div class="cover-container">

                    <div class="clearfix">
                        <div class="inner">
                            <h3 class="masthead-brand">1stAmendment</h3>
                            <nav>
                                <ul class="nav masthead-nav">
                                    <!--Navigation Bar-->
                                    <li><a href="index.php">Home</a></li>
                                    <li class="active"><a href="list.php">Protests</a></li>
                                    <li><a href="signup.php">Sign Up</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="inner cover">

                            <?php
                            // Event ID received from protest list
                            $eventID = $_GET["eventID"];
                            // MySQL Connection info
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "1stamendment";

                            try {
                                // create new PDO connection object
                                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                // set the PDO error mode to exception
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $sql = "SELECT eventID, eventName, date_format(date, '%Y-%m-%dT%H:%i:%s') as date_weatherformat, date_format(date, '%M %e, %Y') 
as formatted_date, date_format(startTime, '%l:%i %p') as formatted_startTime, date_format(endTime, '%l:%i %p') as formatted_endTime, startAddress, startCity, startState, startZipCode, endAddress, endCity, endState, endZipCode, description FROM events WHERE eventID = $eventID";
                                $stmt = $conn->query($sql);
                                $row = $stmt->fetchObject();
                                $conn = null;
                                //echo $row->eventName;
                            } catch (PDOException $e) {
                                echo $sql . "<br>" . $e->getMessage();
                            }
                            ?>
                            <!--Display details of protest event pulled from DB-->
                            <h1 class="cover-heading"><?php echo $row->eventName; ?></h1>

                            <h4>Description</h4>
                            <p class="lead"><?php echo $row->description; ?></p>


                            <h4>Date</h4>
                            <p class="lead"><?php echo $row->formatted_date; ?></p>
                            <h4>Start Time</h4>
                            <p class="lead"><?php echo $row->formatted_startTime; ?></p>
                            <h4>End Time</h4>
                            <p class="lead"><?php echo $row->formatted_endTime; ?></p>
                            <h4>Start Location</h4>
                            <p class="lead" name="start"><?php echo $row->startAddress . " " . $row->startCity . ", " . $row->startState . " " . $row->startZipCode; ?></p>
                            <h4>Destination Location</h4>
                            <p class="lead" name="destination"><?php echo $row->endAddress . " " . $row->endCity . ", " . $row->endState . " " . $row->endZipCode; ?></p>


                            <?php
                            // set origin and destination of route into array
                            $routeQuery = array("origin" => $row->startAddress . " " . $row->startCity . ", " . $row->startState, "destination" => $row->endAddress . " " . $row->endCity . ", " . $row->endState);
                            ?>
                            <!--Pass origin and destination addresses to Google Maps route API-->
                            <iframe src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyCOLmKhpy5WMvHzcoXV1DYQc-9ICZ4e1Xg&<?php echo http_build_query($routeQuery); ?>&mode=walking" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>


<?php
// Get latitude and longitude through Google Maps Geocoding API 
$query = array("address" => $row->startAddress . " " . $row->startCity . ", " . $row->startState, "key" => "AIzaSyCOLmKhpy5WMvHzcoXV1DYQc-9ICZ4e1Xg");

$geocodeCurl = curl_init();
curl_setopt($geocodeCurl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($geocodeCurl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($geocodeCurl, CURLOPT_URL, "https://maps.googleapis.com/maps/api/geocode/json" . "?" . http_build_query($query));
$geocodeResult = json_decode(curl_exec($geocodeCurl));

// Retrieve latitude and longitude from JSON response
$latitude = $geocodeResult->results[0]->geometry->location->lat;
$longitude = $geocodeResult->results[0]->geometry->location->lng;
$weatherdate = $row->date_weatherformat;

// Pass date, longitude and latitude to Darksky API
$weatherCurl = curl_init();
curl_setopt($weatherCurl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($weatherCurl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($weatherCurl, CURLOPT_URL, "https://api.darksky.net/forecast/77fa5da53ed9db102ac6c26f73c7a336/" . $latitude . "," . $longitude . "," . $weatherdate . "?exclude=currently,hourly,minutely,flags,alerts&units=us");
$weatherResult = json_decode(curl_exec($weatherCurl));
//echo json_encode($weatherResult);
// Retrieve Minimum and Maximum Temperture from JSON response
$roundedMinTemp = round($weatherResult->daily->data[0]->temperatureMin);
$roundedMaxTemp = round($weatherResult->daily->data[0]->temperatureMax);
?>
                            <!--Display weather info in table-->
                            <h2>Weather</h2>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Weather Description</th>
                                    <th>Temperature Low</th>
                                    <th>Temperature High</th>
                                </tr>
                                <tr>
<?php
echo "<td>" . $weatherResult->daily->data[0]->summary . "</td>";
echo "<td>" . $roundedMinTemp . "&deg;F</td>";
echo "<td>" . $roundedMaxTemp . "&deg;F</td>";
?>
                                </tr>
                            </table>

                        </div>

                        <script src="bootstrap/js/bootstrap.min.js"></script>
                        </body>

                    </div>

                </div>
            </div>
        </div>

</html>
