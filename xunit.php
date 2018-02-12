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
        try {
            $method = $this->name;
            $this->$method();
        } catch (Exception $e) {
            $result->testFailed();
        }
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

    public function testBrokenMethod()
    {
        throw new Exception();
    }
}

/**
 * Class TestResult
 */
class TestResult
{
    private $runCount;
    private $errorCount;

    public function __construct()
    {
        $this->runCount = 0;
        $this->errorCount = 0;
    }

    public function testStarted()
    {
        $this->runCount = $this->runCount + 1;
    }

    public function testFailed()
    {
        $this->errorCount = $this->errorCount + 1;
    }

    public function summary()
    {
        return sprintf("%d run, %d failed", $this->runCount, $this->errorCount);
    }
}

/**
 * Class TestSuite
 */
class TestSuite
{
    private $tests;

    public function __construct()
    {
        $this->tests = [];
    }

    public function add($test)
    {
        $this->tests[] = $test;
    }

    public function run()
    {
        $result = new TestResult();
        foreach ($this->tests as $test) {
            $test->run($result);
        }
        return $result;
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
        assert("1 run, 0 failed" == $result->summary());
    }

    public function testFailedResult()
    {
        $test = new WasRun("testBrokenMethod");
        $result = $test->run();
        assert("1 run, 1 failed" == $result->summary());
    }

    public function testFailedResultFormatting()
    {
        $result = new TestResult();
        $result->testStarted();
        $result->testFailed();
        assert("1 run, 1 failed" == $result->summary());
    }

    public function testSuite()
    {
        $suite = new TestSuite();
        $suite->add(new WasRun("testMethod"));
        $suite->add(new WasRun("testBrokenMethod"));
        $result = $suite->run();
        assert("2 run, 1 failed" == $result->summary());
    }
}

(new TestCaseTest("testTemplateMethod"))->run()->summary();
(new TestCaseTest("testResult"))->run()->summary();
(new TestCaseTest("testFailedResult"))->run()->summary();
(new TestCaseTest("testFailedResultFormatting"))->run()->summary();
(new TestCaseTest("testSuite"))->run()->summary();
