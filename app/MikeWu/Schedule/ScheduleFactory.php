<?php
/**
 * Created by PhpStorm.
 * User: punker
 * Date: 9/1/14
 * Time: 7:46 PM
 */

namespace MikeWu\Schedule;


class ScheduleFactory {

    /**
     */
    public static function getSchedule($type) {

        switch($type) {
            case "EL":
            case "El":
                return new ElSchedule();
                break;
            case "Metra":
                return new MetraSchedule();
                break;
            case "Amtrak":
                return new AmtrakSchedule();
                break;
            default:
                throw new \Exception("Unkown Line Type");
        }

    }

}