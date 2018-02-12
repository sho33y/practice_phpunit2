<?php
/**
 * Created by PhpStorm.
 * User: yagishitasho
 * Date: 2018/02/12
 * Time: 13:18
 */

class WasRun
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
}

$test = new WasRun("testMethod");
print ($test->wasRun);
$test->testMethod();
print ($test->wasRun);