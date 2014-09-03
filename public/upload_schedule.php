<?php
/**
 * Created by PhpStorm.
 * User: punker
 * Date: 9/3/14
 * Time: 2:19 PM
 */
require_once "../vendor/autoload.php";

use MikeWu\Schedule\ScheduleFactory;
use MikeWu\Schedule\CsvParser;
use MikeWu\Schedule\FileReader;
use MikeWu\Schedule\ScheduleDao;

// This file will be responsible for catching the uploaded file, parsing it and presenting to the user.
// Make sure we have no error on upload.
if($_FILES["new_schedule"]["error"] > 0) {
    echo "Something went wrong.";
    die;
}
// Read the temporary file using instance of file reader class.
$file = FileReader::readFile($_FILES["new_schedule"]["tmp_name"]);

// Instantiate CsvParser and parse the file.  We will get array of schedules in return. Each array key will be hold Run Number and the value is the Schedule Object itself
// This allows easy sorting.

$parser = new CsvParser();
$schedule_objects = $parser->parseSchedule($file);

// Sort array of Schedules using key ( key is the run number)
ksort($schedule_objects);
?>

<h3>Uploaded Schedule</h3>
<table>
    <thead>
    <tr>
        <th>Train Line</th>
        <th>Route</th>
        <th>Run Number</th>
        <th>Operator ID</th>
        <th>Action</th>
    </tr>
    </thead>
    <?php
    // Show sorted schedule list to the user.
    foreach($schedule_objects as $schedule) {

        echo "<tr>";
        echo sprintf("<td>%s</td><td>%s</td><td>%s</td><td>%s</td>",
            $schedule->getTrain_line(), $schedule->getRoute_name(), $schedule->getRun_number(), $schedule->getOperator_id());
        echo "</tr>";
    }
    ?>

</table>

    <!-- Generate form with all the objects created from CSV file.  This will allow us to pass arrays that DAO's create method takes as an argument -->

    <form action="/schedule/create" method="POST">
        <?php
        $i = 0;
        foreach($schedule_objects as $schedule) {
            echo sprintf("<input type='hidden' name=\"%s[train_line]\" value=\"%s\" >",$i,$schedule->getTrain_line());
            echo sprintf("<input type='hidden' name=\"%s[route_name]\" value=\"%s\" >",$i,$schedule->getRoute_name());
            echo sprintf("<input type='hidden' name=\"%s[run_number]\" value=\"%s\" >",$i,$schedule->getRun_number());
            echo sprintf("<input type='hidden' name=\"%s[operator_id]\" value=\"%s\" >",$i,$schedule->getOperator_id());
            $i++;
        }
        ?>
        <input type="submit" value="Save">
    </form>
