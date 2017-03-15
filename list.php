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

                    <div class="masthead clearfix">
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
                            <h1 class="cover-heading">Upcoming Protests</h1>

                            <a class="btn btn-default" href="submit.php" role="button">Add New Protest</a>

                            <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "1stamendment";

                            try {
                                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                // set the PDO error mode to exception
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $sql = "SELECT 	eventID, eventName, date_format(date, '%M %e, %Y') 
as formatted_date, startCity, startState FROM events";
                                $stmt = $conn->query($sql);

                                //echo $row->eventName;
                            } catch (PDOException $e) {
                                echo $sql . "<br>" . $e->getMessage();
                            }

                            $conn = null;
                            ?>

                            <table class='table table-hover'>
                                <thead>
                                    <tr>
                                        <th>Event</th>
                                        <th>Date</th>
                                        <th>City</th>
                                        <th>State</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = $stmt->fetchObject()) {
                                        echo "<tr onclick='showDetails($row->eventID)'>";
                                        echo "<td>" . $row->eventName . "</td>";
                                        echo "<td>" . $row->formatted_date . "</td>";
                                        echo "<td>" . $row->startCity . "</td>";
                                        echo "<td>" . $row->startState . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>



                            <script>
                                function showDetails(eventID) {
                                    location.href = "details.php?eventID=" + eventID;
                                }
                            </script>



                        </div>

                        <script src="bootstrap/js/bootstrap.min.js"></script>
                        </body>

                    </div>

                </div>
            </div>
        </div>

</html>
