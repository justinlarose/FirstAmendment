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
                            <h1 class="cover-heading">Submit a New Protest</h1>


                            <form>
                                <div class="form-group">
                                    <label for="inputEvent">Name of Event</label>
                                    <input type="text" class="form-control" id="inputEvent" placeholder="Name of Event">
                                </div>

                                <div class="form-group">
                                    <label for="eventDescription">Description of Event</label>
                                    <textarea class="form-control" rows="3" id="eventDescription" placeholder="Brief description of the event"></textarea>
                                </div>

                            </form>

                            <!-- Text input-->
                            <form class="form-inline">

                                <div class="form-group">
                                    <label for="inputDataTime1">Start Time</label>
                                    <input type="datetime-local" class="form-control" id="inputDataTime1" >
                                </div>
                                <div class="form-group">
                                    <label for="inputDataTime2">End Time</label>
                                    <input type="datetime-local" class="form-control" id="inputDataTime2" >
                                </div>
                            </form>

                            <h4>Start Information</h4>
                            <form>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Street Address">
                                </div>
                            </form>
                            <form class="form-inline">
                                <!-- Text input-->
                                <div class="form-group">

                                    <input type="text" class="form-control" placeholder="City">
                                </div>

                                <!-- Text input-->
                                <div class="form-group">

                                    <input type="text" class="form-control" placeholder="State" >
                                </div>

                                <div class="form-group">

                                    <input type="text" class="form-control" placeholder="Zipcode" >
                                </div>

                            </form>

                            <!-- Text input-->
                            <h4>Destination Information</h4>
                            <form>


                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Street Address">
                                </div>
                            </form>
                            <form class="form-inline">
                                <!-- Text input-->
                                <div class="form-group">

                                    <input type="text" class="form-control" placeholder="City">
                                </div>

                                <!-- Text input-->
                                <div class="form-group">

                                    <input type="text" class="form-control" placeholder="State" >
                                </div>

                                <div class="form-group">

                                    <input type="text" class="form-control" placeholder="Zipcode" >
                                </div>

                            </form>




                            <button type="submit" class="btn btn-default">Submit</button>
                            </form>
                        </div>

                        <script src="bootstrap/js/bootstrap.min.js"></script>
                        </body>

                    </div>

                </div>
            </div>
        </div>





</html>
