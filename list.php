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
                            echo "<table class='table table-hover'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>Event ID</th>";
                            echo "<th>Event</th>";
                            echo "<th>Date</th>";
                            echo "<th>City</th>";
                            echo "<th>State</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";

                            class TableRows extends RecursiveIteratorIterator {

                                function __construct($it) {
                                    parent::__construct($it, self::LEAVES_ONLY);
                                }

                                function current() {
                                    return "<td>" . parent::current() . "</td>";
                                }

                                function beginChildren() {
                                    echo "<tr onclick='showDetails(this)'>";
                                }

                                function endChildren() {
                                    echo "</tr>" . "\n";
                                }

                            }

                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "1stamendment";

                            try {
                                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                // set the PDO error mode to exception
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $stmt = $conn->prepare("SELECT 	eventID, eventName, date_format(date, '%M %e, %Y') 
as formatted_date, startCity, startState FROM events");

                                $stmt->execute();

                                // set the resulting array to associative
                                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k => $v) {
                                    echo $v;
                                }
                            } catch (PDOException $e) {
                                echo $sql . "<br>" . $e->getMessage();
                            }

                            $conn = null;
                            echo "</tbody>";
                            echo "</table>";
                            ?>


    <script>
function showDetails(x) {
    //alert("Row index is: " + x.rowIndex);
    location.href = "details.php?eventID=14";
}
</script>
 
<!--      <tr onclick="window.location.href = 'details.php';">
        <td>No More Final Exams!!</td>
        <td>March 18, 2017</td>
        <td>Cambridge</td>
        <td>MA</td>
      </tr>
      <tr>
        <td>Blame Canada!</td>
        <td>June 24, 2017</td>
        <td>Detroit</td>
        <td>MI</td>
      </tr>
      <tr>
        <td>Stop The Bad Movie Sequels!</td>
        <td>May 4, 2017</td>
        <td>Hollywood</td>
        <td>CA</td>
      </tr>
    </tbody>
  </table>-->


                        </div>

                        <script src="bootstrap/js/bootstrap.min.js"></script>
                        </body>

                    </div>

                </div>
            </div>
        </div>

</html>
