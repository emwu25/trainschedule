<?php
/**
 * Created by PhpStorm.
 * User: punker
 * Date: 9/3/14
 * Time: 1:28 PM
 */

require_once "../vendor/autoload.php";

//use MikeWu\Schedule\ScheduleFactory;
use MikeWu\Schedule\ScheduleDao;

$db = new PDO('mysql:host=localhost;dbname=schedule;charset=utf8', 'schedule', 'test', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$schedule_dao = new ScheduleDao($db);

$schdule_id = htmlentities($_REQUEST["schedule"]);

// Have the DAO find the object we want to update.
$schedule = $schedule_dao->find($schdule_id);

// THOSE INPUTS SHOULD BY PROPERLY VALIDATED AND SANITIZED IN REAL WORLD APP
// Use the form fields to update values of requested schedule object.
// Save changes to the object using DAO.
$schedule->setRoute_name($_REQUEST["route_name"]);
$schedule->setRun_number($_REQUEST["run_number"]);
$schedule->setOperator_id($_REQUEST["operator_id"]);
$schedule_dao->save($schedule);
header("Location: /schedule/".$schdule_id);