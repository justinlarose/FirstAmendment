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
                            <!--Navigation Bar-->
                            <nav>
                                <ul class="nav masthead-nav">
                                    <li><a href="index.php">Home</a></li>
                                    <li class="active"><a href="list.php">Protests</a></li>
                                    <li><a href="signup.php">Sign Up</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="inner cover">
                            <h1 class="cover-heading">Submit a New Protest</h1>

                            <!--Event submission form-->
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="inputEvent">Name of Event</label>
                                    <input type="text" class="form-control" name="inputEvent" placeholder="Name of Event">
                                </div>

                                <div class="form-group">
                                    <label for="eventDescription">Description of Event</label>
                                    <textarea class="form-control" rows="3" name="eventDescription" placeholder="Brief description of the event"></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label for="eventDate">Event Date</label>
                                    <input type="date" class="form-control" name="eventDate" >
                                </div>

                                <div class="form-group">
                                    <label for="inputStartTime">Start Time</label>
                                    <input type="time" class="form-control" name="inputStartTime" >
                                </div>
                                <div class="form-group">
                                    <label for="inputEndTime">End Time</label>
                                    <input type="time" class="form-control" name="inputEndTime" >
                                </div>


                                <h4>Start Information</h4>

                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Street Address" name="inputStartStreet">
                                </div>


                                <!-- Text input-->
                                <div class="form-group">

                                    <input type="text" class="form-control" placeholder="City" name="startCity">
                                </div>

                                <!-- Text input-->
                                <div class="form-group">

                                    <input type="text" class="form-control" placeholder="State" name="startState">
                                </div>

                                <div class="form-group">

                                    <input type="text" class="form-control" placeholder="Zipcode" name="startZip" >
                                </div>



                                <!-- Text input-->
                                <h4>Destination Information</h4>



                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Street Address" name="inputEndStreet">
                                </div>


                                <!-- Text input-->
                                <div class="form-group">

                                    <input type="text" class="form-control" placeholder="City" name="endCity">
                                </div>

                                <!-- Text input-->
                                <div class="form-group">

                                    <input type="text" class="form-control" placeholder="State" name="endState">
                                </div>

                                <div class="form-group">

                                    <input type="text" class="form-control" placeholder="Zipcode" name="endZip">
                                </div>


                                <button type="submit" class="btn btn-default">Submit</button>
                            </form>
                        </div>

                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == "POST") {
                            //MySQL DB connection info
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "1stamendment";
                            
                          
                            $inputEvent = $_POST["inputEvent"];
                            $eventDescription = $_POST["eventDescription"];
                            $eventDate = $_POST["eventDate"];
                            $inputStartTime = $_POST["inputStartTime"];
                            $inputEndTime = $_POST["inputEndTime"];
                            $inputStartStreet = $_POST["inputStartStreet"];
                            $startCity = $_POST["startCity"];
                            $startState = $_POST["startState"];
                            $startZip = $_POST["startZip"];
                            $inputEndStreet = $_POST["inputEndStreet"];
                            $endCity = $_POST["endCity"];
                            $endState = $_POST["endState"];
                            $endZip = $_POST["endZip"];


                            try {
                                // Insert Protest Event form information to DB
                                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                // set the PDO error mode to exception
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $sql = "INSERT INTO events (eventName, description, date, startTime, endTime, startAddress, startCity, startState, startZipCode, endAddress, endCity, endState, endZipCode) VALUES ('$inputEvent', '$eventDescription', '$eventDate','$inputStartTime', '$inputEndTime', '$inputStartStreet','$startCity','$startState','$startZip','$inputEndStreet','$endCity','$endState','$endZip')";
                                if ($conn->query($sql)) {
                                    echo "<script type= 'text/javascript'>alert('New Protest Added');</script>";
                                } else {
                                    echo "<script type= 'text/javascript'>alert('Error: Unable To Add Protest');</script>";
                                }
                              
                            } catch (PDOException $e) {
                                echo $sql . "<br>" . $e->getMessage();
                            }
                               // Close connection
                            $conn = null;
                        }
                        ?>



                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
                        <script src="bootstrap/js/bootstrap.min.js"></script>
                        </body>

                    </div>

                </div>
            </div>
        </div>





</html>
