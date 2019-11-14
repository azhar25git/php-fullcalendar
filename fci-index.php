<?php

/**
 * Fullcalendar Integraton with PHP
 * 
 * PHP version 5, 7
 * 
 * @author Azhar Uddin
 * @license MIT
 * @link https://fiverr.com/flybycom
 * 
 * @version 3.3
 * 
 */
// session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("database.php");
include("fci-functions.php");

?>

<!doctype html>
<html lang="en">

<head>
    <title>jQuery Fullcalendar Integration- Flybycom</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <style type="text/css">
        img {
            border-width: 0
        }

        * {
            font-family: 'Lucida Grande', sans-serif;
        }
    </style>
</head>

<body>

    </div>
    <style type="text/css">
        #calendar {
            width: 100%;
        }

        .fc-event-container {
            color: #fff;
        }
    </style>
    <hr />

    <!-- Load styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="css/fullcalendar.css" rel="stylesheet" />
    <link href="css/fullcalendar.print.css" rel="stylesheet" media="print" />


    <!-- add calander in this div -->
    <div class="container">
        <div class="row">
            <div id="calendar"></div>

        </div>
    </div>


    <!-- Modal -->
    <div id="createEventModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Event</h4>
                    <button type="button" class="close" data-dismiss="modal" >&times;</button>
                </div>
                <div class="modal-body">

                    <?php include('fci-event-create.php'); ?>

                    <input type="hidden" id="startTime" />
                    <input type="hidden" id="endTime" />


                    <br />
                    <div class="control-group">
                        <label class="control-label" for="when">When:</label>
                        <div class="controls controls-row" id="when" style="margin-top:5px;">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submitButton">Save</button>
                </div>
            </div>

        </div>
    </div>


    <div id="calendarModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Event Details</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div id="modalBody" class="modal-body">
                    <h4 id="modalTitle" class="modal-title"></h4>
                    <div id="modalWhen" style="margin-top:5px;"></div>

                    <!-- <?php //include('fci-event-create.php'); 
                            ?> -->
                </div>
                <input type="hidden" id="eventID" />
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                    <button type="submit" class="btn btn-danger" id="deleteButton">Delete</button>
                    <button class="btn btn-danger" id="deleteGroup">Delete All</button>
                </div>
            </div>
        </div>
    </div>
    <!--Modal-->


    <div style='margin-left: auto;margin-right: auto;text-align: center;'>
    </div>

    <!-- Load scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="js/moment.min.js"></script>
    <script src="js/fullcalendar.js"></script>
    <script type="text/javascript" src="js/script.js"></script>

</body>

</html>