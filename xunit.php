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

    /**
     * WasRun constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->wasRun = false;
    }

    public function testMethod()
    {
        $this->wasRun = 1;
    }
}

$test = new WasRun("testMethod");
print ($test->wasRun);
$test->testMethod();
print ($test->wasRun);