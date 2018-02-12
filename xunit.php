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
        $result = new TestResult();
        $result->testStarted();
        $this->setUp();
        $method = $this->name;
        $this->$method();
        $this->tearDown();
        return $result;
    }

    public function tearDown()
    {
    }
}

/**
 * Class WasRun
 */
class WasRun extends TestCase
{
    public $wasSetUp;
    public $log;
    
    public function setUp()
    {
        $this->log = "setUp ";
    }

    public function testMethod()
    {
        $this->log = $this->log . "testMethod ";
    }

    public function tearDown()
    {
        $this->log = $this->log . "tearDown ";
    }
}

/**
 * Class TestResult
 */
class TestResult
{
    private $runCount;

    public function __construct()
    {
        $this->runCount = 0;
    }

    public function testStarted()
    {
        $this->runCount = $this->runCount + 1;
    }

    public function summary()
    {
        return sprintf("%d run, 0 faild", $this->runCount);
    }
}

/**
 * Class TestCaseTest
 */
class TestCaseTest extends TestCase
{
    public function testTemplateMethod()
    {
        $test = new WasRun("testMethod");
        $test->run();
        assert("setUp testMethod tearDown " == $test->log);
    }

    public function testResult()
    {
        $test = new WasRun("testMethod");
        $result = $test->run();
        assert("1 run, 0 faild" == $result->summary());
    }
}

(new TestCaseTest("testTemplateMethod"))->run();
(new TestCaseTest("testResult"))->run();
