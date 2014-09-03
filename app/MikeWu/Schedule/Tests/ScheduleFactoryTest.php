<?php
/**
 * Created by PhpStorm.
 * User: punker
 * Date: 9/1/14
 * Time: 8:09 PM
 */

namespace MikeWu\Schedule\Tests;

use MikeWu\Schedule\ScheduleFactory;
use MikeWu\Schedule\ElSchedule;
use MikeWu\Schedule\MetraSchedule;
use \Exception;

class ScheduleFactoryTest extends \PHPUnit_Framework_TestCase {

    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->ScheduleFactory = new ScheduleFactory();
    }
    public function testFactoryConstruct() {
        $this->assertInstanceOf("MikeWu\\Schedule\\ScheduleFactory", $this->ScheduleFactory);
    }

    public function testGetInstanceMethod()
    {
        $this->assertInstanceOf("MikeWu\\Schedule\\ElSchedule", $this->ScheduleFactory->getSchedule("EL"));
        $this->assertInstanceOf("MikeWu\\Schedule\\AmtrakSchedule", $this->ScheduleFactory->getSchedule("Amtrak"));
        $this->assertInstanceOf("MikeWu\\Schedule\\MetraSchedule", $this->ScheduleFactory->getSchedule("Metra"));
        $this->setExpectedException('Exception');
        $this->ScheduleFactory->getSchedule("lkajsldfkajsdf");
    }

    protected function tearDown() {
        $this->ScheduleFactory = null;
        parent::tearDown();
    }
}
 