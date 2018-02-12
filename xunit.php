<?php
/**
 * Created by PhpStorm.
 * User: yagishitasho
 * Date: 2018/02/12
 * Time: 13:18
 */

/**
 * Class TestCase
 */
class TestCase
{
    public $name;

    /**
     * TestCase constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function setUp()
    {
    }

    public function run()
    {
        $this->setUp();
        $method = $this->name;
        $this->$method();
    }
}

/**
 * Class WasRun
 */
class WasRun extends TestCase
{
    public $wasRun;
    public $wasSetUp;
    public $log;
    
    public function setUp()
    {
        $this->wasRun = null;
        $this->log = "setUp ";
    }

    public function testMethod()
    {
        $this->log = $this->log . "testMethod ";
    }
}

/**
 * Class TestCaseTest
 */
class TestCaseTest extends TestCase
{
    private $test;

    public function setUp()
    {
        $this->test = new WasRun("testMethod");
    }

    public function testRunning()
    {
        $this->test->run();
        assert($this->test->wasRun);
    }

    public function testSetUp()
    {
        $this->test->run();
        assert("setUp testMethod " == $this->test->log);
    }
}

(new TestCaseTest("testRunning"))->run();
(new TestCaseTest("testSetUp"))->run();