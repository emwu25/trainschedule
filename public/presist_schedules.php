<?php
/**
 * Created by PhpStorm.
 * User: punker
 * Date: 9/3/14
 * Time: 3:30 PM
 */

require_once "../vendor/autoload.php";

use MikeWu\Schedule\ScheduleDao;

$db = new PDO('mysql:host=localhost;dbname=schedule;charset=utf8', 'schedule', 'test', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$schedule_dao = new ScheduleDao($db);

// We will receive input of temporarily parsed Schedule objects as an array and use DAOs create method to insert each of those items into the database.  Input should be validated and sanitized in real world app.
// We should use some error handling too.  Also, dealing with relatively big forms like this becomes clunky, and I would consider using json here instead.

foreach($_POST as $schedule_array) {
    $schedule_dao->create($schedule_array);
}

header("Location: /schedule");