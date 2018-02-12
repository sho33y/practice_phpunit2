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

    public function run()
    {
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

    /**
     * WasRun constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->wasRun = null;
        parent::__construct($name);
    }

    public function testMethod()
    {
        $this->wasRun = 1;
    }
}

/**
 * Class TestCaseTest
 */
class TestCaseTest extends TestCase
{
    public function testRunning()
    {
        $test = new WasRun("testMethod");
        assert(!$test->wasRun);
        $test->run();
        assert($test->wasRun);
    }
}

(new TestCaseTest("testRunning"))->run();