<?php
/**
 * Created by PhpStorm.
 * User: punker
 * Date: 9/1/14
 * Time: 7:44 PM
 */

namespace MikeWu\Schedule;


class AmtrakSchedule extends Schedule {

    /**
     */
    function __construct() {
        $this->train_line = "Amtrak";
    }
}