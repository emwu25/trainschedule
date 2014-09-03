<?php
/**
 * Created by PhpStorm.
 * User: punker
 * Date: 9/1/14
 * Time: 7:38 PM
 */

namespace MikeWu\Schedule;

abstract class Schedule {

    /**
     */
    protected $id;
    protected $train_line;
    protected $route_name;
    protected $run_number;
    protected $operator_id;


    function __construct() {
    }
    /**
     * @return the $id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return the $train_line
     */
    public function getTrain_line() {
        return $this->train_line;
    }

    /**
     * @return the $route_name
     */
    public function getRoute_name() {
        return $this->route_name;
    }

    /**
     * @return the $run_number
     */
    public function getRun_number() {
        return $this->run_number;
    }

    /**
     * @return the $operator_id
     */
    public function getOperator_id() {
        return $this->operator_id;
    }

    /**
     * @param field_type $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @param field_type $route_name
     */
    public function setRoute_name($route_name) {
        $this->route_name = $route_name;
    }

    /**
     * @param field_type $run_number
     */
    public function setRun_number($run_number) {
        $this->run_number = $run_number;
    }

    /**
     * @param field_type $operator_id
     */
    public function setOperator_id($operator_id) {
        $this->operator_id = $operator_id;
    }

    public function equals(Schedule $other) {
        if(get_class($this) !== get_class($other))
            return false;
        if($this->getOperator_id() !== $other->getOperator_id())
            return false;
        if($this->getRoute_name() !== $other->getRoute_name())
            return false;
        if($this->getRun_number() !== $other->getRun_number())
            return false;

        return true;
    }

    public function getHashCode() {
        $to_be_hashed = sprintf("%s%s%s%s", $this->train_line,$this->route_name,$this->run_number,$this->operator_id);
        return md5($to_be_hashed);
    }


}

?>