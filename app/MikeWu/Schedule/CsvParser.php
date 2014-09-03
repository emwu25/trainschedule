<?php
/**
 * Created by PhpStorm.
 * User: punker
 * Date: 9/1/14
 * Time: 9:28 PM
 */

namespace MikeWu\Schedule;


class CsvParser implements ScheduleParser{



    public function parseSchedule($lines)
    {
        $schedule_list = array();
        for($i = 1 ; $i < count($lines); $i++) {
            // Parse each line and turn it to object.
            $schedule_object = $this->parseLine($lines[$i]);
            // We will hash each object by its properties to make sure we do not add duplicates.
            if(!array_key_exists($schedule_object->getHashCode(),$schedule_list)) {
                $schedule_list[$schedule_object->getHashCode()] = $schedule_object;
            }
        }
        // Once we have all objects we need, lets assign meaningful keys to enable easy sorting
        return $this->reasignKeys($schedule_list);

    }

    private function parseLine($line) {
        $line_items = explode(", ",$line);
        $schedule_item = ScheduleFactory::getSchedule($line_items[0]);
        $schedule_item->setRoute_name($line_items[1]);
        $schedule_item->setRun_number($line_items[2]);
        $schedule_item->setOperator_id($line_items[3]);
        return $schedule_item;
    }
    private function reasignKeys($array) {
        $new_array = array();
        foreach($array as $key => $val) {
            // We will use this function recursively to make sure
            // we assign unique key to the schedule at hand.
            // For example if Metra and EL share run number,
            // We need to be able to accomodate for that.
            $this->assignKey($new_array, $val->getRun_number(), $val);
        }
        return $new_array;
    }

    private function assignKey(& $array, $key, $object) {
        // keeps calling itself and padding run number with 0s until free one is found.
        // We dont care at this point that run numbers are changed because we will use them
        // only for sort purposes.  The run numbers do not change inside the objects.
        if(array_key_exists($key, $array)) {
            $padded_key = $key . "0";
            $this->assignKey($array, $padded_key, $object);
        } else {
            $array[$key] = $object;
        }
    }

} 