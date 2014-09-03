<?php
/**
 * Created by PhpStorm.
 * User: punker
 * Date: 9/3/14
 * Time: 2:06 PM
 */

// user composers autload to load required classes.
require_once "../vendor/autoload.php";

// We will need Database Access Object to list current schedules in the database.
use MikeWu\Schedule\ScheduleDao;

// Create PDO instance that we will inject into Database access object.
$db = new PDO('mysql:host=localhost;dbname=schedule;charset=utf8', 'schedule', 'test', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$schedule_dao = new ScheduleDao($db);

// get the id of schedule item we want to delete.  NOTICE: Even tho we are using PDO this input should be validated in real world app.
$schedule_id = $_REQUEST["schedule"];
// request the instance of the schedule we want to delete from DAO
$schedule = $schedule_dao->find($schedule_id);

// have DAO delete the object from the database
$schedule_dao->delete($schedule);

// Redirect back to main page.
header("Location: /schedule");