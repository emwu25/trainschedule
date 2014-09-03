<?php
/**
 * Created by PhpStorm.
 * User: punker
 * Date: 9/3/14
 * Time: 4:19 AM
 */

namespace MikeWu\Schedule;
use MikeWu\Schedule\ScheduleFactory;
use PDO;
class ScheduleDao {

    public function __construct($db) {
        $this->db = $db;
    }

    public function find($id) {
        $result_objects = array();
        $stmt = $this->db->prepare("SELECT * FROM schedules WHERE id= :id");
        $stmt->execute(["id"=> $id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Iterating over rows. We should get only one.
        $result_object = null;
        foreach($rows as $row) {
            $result_object = ScheduleFactory::getSchedule($row["train_line"]);
            $result_object->setOperator_id($row["operator_id"]);
            $result_object->setRun_number($row["run_number"]);
            $result_object->setRoute_name($row["route_name"]);
            $result_object->setId($row["id"]);
        }
        return $result_object;
    }

    public function create($array) {
            $array["dupa"] = "pipa";
            $stmt = $this->db->prepare("INSERT INTO schedules(`train_line`,`route_name`,`run_number`,`operator_id`) VALUES(:train_line,:route_name,:run_number,:operator_id)");
            $stmt->execute(array(':train_line' => $array["train_line"], ':route_name' => $array["route_name"], ':run_number' => $array["run_number"], ':operator_id' => $array["operator_id"]));
            $affected_rows = $stmt->rowCount();
    }

    public function save($schedule) {
        $stmt = $this->db->prepare("UPDATE schedules SET train_line= :train_line, route_name = :route_name, run_number= :run_number, operator_id= :operator_id  WHERE id= :id");
        $stmt->execute(["train_line" => $schedule->getTrain_line(), "route_name" => $schedule->getRoute_name(), "run_number"=> $schedule->getRun_number(), "operator_id"=> $schedule->getOperator_id(), "id" => $schedule->getId()]);
        $affected_rows = $stmt->rowCount();
    }

    public function delete($schedule) {
        $stmt = $this->db->prepare("DELETE FROM schedules WHERE id= :id");
        $stmt->execute(["id" => $schedule->getId()]);
        $affected_rows = $stmt->rowCount();
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM schedules ORDER BY `run_number` ASC");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result_objects = array();
        foreach($rows as $row) {
            $result_object = ScheduleFactory::getSchedule($row["train_line"]);
            $result_object->setOperator_id($row["operator_id"]);
            $result_object->setRun_number($row["run_number"]);
            $result_object->setRoute_name($row["route_name"]);
            $result_object->setId($row["id"]);
            $result_objects[] = $result_object;
        }
        return $result_objects;
    }

} 