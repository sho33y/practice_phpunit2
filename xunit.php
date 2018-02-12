<?php
/**
 * Created by PhpStorm.
 * User: yagishitasho
 * Date: 2018/02/12
 * Time: 13:18
 */

use PHPUnit\Framework\TestCase;

/**
 * Class WasRun
 */
class WasRun extends TestCase
{
    public $wasRun;
    public $name;

    /**
     * WasRun constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->wasRun = false;
        $this->name = $name;
    }

    public function testMethod()
    {
        $this->wasRun = 1;
    }

    public function run()
    {
        $method = $this->name;
        $this->$method();
    }
}

$test = new WasRun("testMethod");
print ($test->wasRun);
$test->run();
print ($test->wasRun);