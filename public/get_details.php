<?php
/**
 * Created by PhpStorm.
 * User: punker
 * Date: 9/3/14
 * Time: 1:12 PM
 */

// LOAD necessary classes
require_once "../vendor/autoload.php";
use MikeWu\Schedule\ScheduleDao;

// Initialize PDO and Database Access Object
$db = new PDO('mysql:host=localhost;dbname=schedule;charset=utf8', 'schedule', 'test', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$schedule_dao = new ScheduleDao($db);

// Request needed Schedule from DAO object
$schedule_id = $_REQUEST["schedule"];
$schedule = $schedule_dao->find($schedule_id);

?>

<!-- SHOW DETAILS TO THE USER / ENABLE USER TO EDIT THE SCHEDULE OBJECT -->

<h1>Schedule details for id: <?php echo $schedule_id;?></h1>

<form action="/schedule/<?php echo $schedule->getId() ?>" method="Post">
<ul>
    <li>Train Line: <?php echo $schedule->getTrain_line(); ?></li>
    <li>Route Name: <?php echo sprintf('<input type="text" name="route_name" value="%s"/>', $schedule->getRoute_name());?> </li>
    <li>Run Number: <?php echo sprintf('<input type="text" name="run_number" value="%s"/>', $schedule->getRun_number());?></li>
    <li>Operator Id: <?php echo sprintf('<input type="text" name="operator_id" value="%s"/>', $schedule->getOperator_id()); ?></li>
</ul>
<input type="submit" value="Update"/>
</form>

