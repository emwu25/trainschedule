<?php
/**
 * Created by PhpStorm.
 * User: punker
 * Date: 9/1/14
 * Time: 6:46 PM
 */

// Autoload required classes.
require_once "../vendor/autoload.php";

// Initialize Database Access Object and PDO.  This will allow us to read items from database.
use MikeWu\Schedule\ScheduleDao;
$db = new PDO('mysql:host=localhost;dbname=schedule;charset=utf8', 'schedule', 'test', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$schedule_dao = new ScheduleDao($db);

// Retrieve all instances of Schedule from database using DAO.
$all_schedules = $schedule_dao->getAll();

?>
<h3>Database Schedule</h3>
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

// Print out list of schedule objects from database.  Add EDIT and DELETE links that will allow to DEMO some of CRUD operations.
foreach($all_schedules as $schedule) {

    echo "<tr>";
    echo sprintf("<td>%s</td><td>%s</td><td>%s</td><td>%s</td><td><a href=\"/schedule/%s\">Edit</a></td><td><a href='/schedule/%s/delete'>Delete</a> </td>",
        $schedule->getTrain_line(), $schedule->getRoute_name(), $schedule->getRun_number(), $schedule->getOperator_id(), $schedule->getId(), $schedule->getId());
    echo "</tr>";
}
?>

</table>

<!-- UPLOAD NEW CSV FORM -->

<h5>Upload Schedule</h5>
    <form action="/schedule/upload" method="post" enctype="multipart/form-data">

        <label for="new_schedule">New Schedule:</label><br/>
        <input name="new_schedule" type="file"/>
        <br/>
        <input type="submit" value="Submit new schedule"/>
    </form>
