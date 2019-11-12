<?php  

if (isset($_POST['action']) or isset($_GET['view'])) {
    
    if (isset($_GET['view'])) {
        header('Content-Type: application/json');
        $start = mysqli_real_escape_string($connection, $_GET["start"]);
        $end = mysqli_real_escape_string($connection, $_GET["end"]);

        $result = mysqli_query($connection, "SELECT `id`, `start` , `end` , `repeating`, `repeating_events_id`, `title` FROM `events` where (date(start) >= '$start' AND date(start) <= '$end')");
        
        while ($row = mysqli_fetch_assoc($result)) {
            $events[] = $row;
        }
        echo json_encode($events);
        exit;

    } elseif ($_POST['action'] == "add") {
        // header('Content-Type: application/json');
        // echo '{"id":"' . $_POST['repeating'] . '"}';
        // exit;
        
        // check if the event is repeating or not
        if ($_POST['repeating'] == 1) {
            
            $r_int = $_POST["repeat_interval"];
            // $r_times = $_POST["repeat_times"];
            $r_total = $_POST["repeat_total"];

            $sql = "INSERT INTO `repeating_events` ( `repeat_times`,`repeat_interval`,`repeat_total` ) VALUES ('" . mysqli_real_escape_string($connection, $_POST["repeat_times"] ) . "', '" . mysqli_real_escape_string($connection, $_POST["repeat_interval"] ) . "', '" . mysqli_real_escape_string($connection, $_POST["repeat_total"] ) . "')";

            if (mysqli_query($connection, $sql)) {
                $repeat_id = mysqli_insert_id($connection);
            }else {
                header('Content-Type: application/json');
                echo '{"id":"' . 'something went wrong' . '"}';
                exit;
            }
            $day_int = 0;
            $r_int_text = '';
            switch ($r_int) {
                case 1:
                    $r_int_text = 'days';
                    break;
                case 2:
                    $r_int_text = 'weeks';
                    break;
                case 3:
                    $r_int_text = 'months';
                    break;
                case 4:
                    $r_int_text = 'years';
                    break;
            }

            for($i=0;$i<$r_total;$i++) {
                
                // date("Y-m-d H:i:s", strtotime('+'. $day_int .' days', strtotime($_POST["start"])) );
                
                $modified_start = date("Y-m-d H:i:s", strtotime('+'. $i . $r_int_text , strtotime($_POST["start"])));
                $modified_end = date("Y-m-d H:i:s", strtotime('+' . $i . $r_int_text , strtotime($_POST["end"])));

                $sql = "INSERT INTO `events` (`title`,`repeating`, `repeating_events_id`,`start`,`end` ) VALUES ('" . mysqli_real_escape_string($connection, $_POST["title"]) . "','" . mysqli_real_escape_string($connection, $_POST["repeating"]) . "','" . $repeat_id . "', '" . mysqli_real_escape_string($connection, $modified_start) . "', '" . mysqli_real_escape_string($connection, $modified_end) . "' )";

                if (mysqli_query($connection, $sql)) {
                    $last_id = mysqli_insert_id($connection);
                } else {
                    header('Content-Type: application/json');
                    echo '{"id":"' . 'something went wrong' . '"}';
                    exit;
                }


            }

            header('Content-Type: application/json');
            echo '{"id":"' . $last_id . '"}';
            exit;
        } if ($_POST['repeating'] == 0) {
            
            $sql = "INSERT INTO `events` (`title`,`repeating`,`start`,`end` ) VALUES ('" . mysqli_real_escape_string($connection, $_POST["title"]) . "','" . mysqli_real_escape_string($connection, $_POST["repeating"]) . "', '" . mysqli_real_escape_string($connection, date('Y-m-d H:i:s', strtotime($_POST["start"]))) . "', '" . mysqli_real_escape_string($connection, date('Y-m-d H:i:s', strtotime($_POST["end"]))) . "' );";

            if (mysqli_query($connection, $sql)) {
                $last_id = mysqli_insert_id($connection);
            } else {
                $last_id = 'something went wrong';
            }

            header('Content-Type: application/json');
            echo '{"id":"' . $last_id . '"}';
            exit;
        }


    } elseif ($_POST['action'] == "update") {
        mysqli_query($connection, "UPDATE `events` set 
            `start` = '" . mysqli_real_escape_string($connection, date('Y-m-d H:i:s', strtotime($_POST["start"]))) . "', 
            `end` = '" . mysqli_real_escape_string($connection, date('Y-m-d H:i:s', strtotime($_POST["end"]))) . "' 
            where id = '" . mysqli_real_escape_string($connection, $_POST["id"]) . "'");
        exit;
    } elseif ($_POST['action'] == "delete") {

        if($_POST['group'] == 'group'){

            $sql = "SELECT `repeating_events_id` FROM `events` WHERE id = '" . mysqli_real_escape_string($connection, $_POST['id']) . "' LIMIT 1";
            $result = mysqli_query($connection, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $events[] = $row;
            }
            $result2 = mysqli_query($connection, "SELECT `id` FROM `events` WHERE `repeating_events_id` = '" . $events[0]['repeating_events_id'] . "'");
            while ($row2 = mysqli_fetch_assoc($result2)) {
                $eventsDel[] = $row2;
            }
            // 
            mysqli_query($connection, "DELETE FROM `events` WHERE `repeating_events_id` = '" . $events[0]['repeating_events_id'] . "'");
            // echo json_encode($events[0]['repeating_events_id']);
 
            if (mysqli_affected_rows($connection) > 0) {
                echo json_encode($eventsDel);
            }
            exit;
        } else {
            mysqli_query($connection, "DELETE from `events` where id = '" . mysqli_real_escape_string($connection, $_POST["id"]) . "'");
            
        }
        if (mysqli_affected_rows($connection) > 0) {
            echo "1";
        }
        exit;
        
    }
}