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
                                    <li><a href="index.php">Home</a></li>
                                    <li class="active"><a href="list.php">Protests</a></li>
                                    <li><a href="#">Sign Up</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="inner cover">

                            <?php
                            $eventID = $_GET["eventID"];

                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "1stamendment";

                            try {

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
                            <p class="lead"><?php echo $row->startAddress . " " . $row->startCity . ", " . $row->startState . " " . $row->startZipCode; ?></p>
                            <h4>Destination Location</h4>
                            <p class="lead"><?php echo $row->endAddress . " " . $row->endCity . ", " . $row->endState . " " . $row->endZipCode; ?></p>

                            <iframe src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d5895.393343616602!2d-71.12554957293153!3d42.370303266744685!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e2!4m5!1s0x89e37743fcedd3c3%3A0xba29e000bdf1e890!2sHarvard+Yard%2C+2+Kirkland+St%2C+Cambridge%2C+MA+02138!3m2!1d42.3743935!2d-71.11625719999999!4m5!1s0x89e377617c1cb3db%3A0x4f962131199b0890!2sHarvard+Stadium%2C+79+N+Harvard+St%2C+Allston%2C+MA+02134!3m2!1d42.366704!2d-71.12675109999999!5e0!3m2!1sen!2sus!4v1488944967921" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>


                            <?php
                            $query = array("address" => $row->startAddress . " " . $row->startCity . ", " . $row->startState, "key" => "AIzaSyBK8gbE5NUVFPva2plI6Ed40RJy0UKc2sI");

                            $geocodeCurl = curl_init();
                            curl_setopt($geocodeCurl, CURLOPT_SSL_VERIFYHOST, false);
                            curl_setopt($geocodeCurl, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($geocodeCurl, CURLOPT_URL, "https://maps.googleapis.com/maps/api/geocode/json" . "?" . http_build_query($query));
                            $geocodeResult = json_decode(curl_exec($geocodeCurl));


                            $latitude = $geocodeResult->results[0]->geometry->location->lat;
                            $longitude = $geocodeResult->results[0]->geometry->location->lng;
                            $weatherdate = $row->date_weatherformat;


                            $weatherCurl = curl_init();
                            curl_setopt($weatherCurl, CURLOPT_SSL_VERIFYHOST, false);
                            curl_setopt($weatherCurl, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($weatherCurl, CURLOPT_URL, "https://api.darksky.net/forecast/77fa5da53ed9db102ac6c26f73c7a336/" . $latitude . "," . $longitude . "," . $weatherdate . "?exclude=currently,hourly,minutely,flags,alerts&units=us");
                            $weatherResult = json_decode(curl_exec($weatherCurl));
                            //echo json_encode($weatherResult);

                            $roundedMinTemp = round($weatherResult->daily->data[0]->temperatureMin);
                            $roundedMaxTemp = round($weatherResult->daily->data[0]->temperatureMax);
                            ?>

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
