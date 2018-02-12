<?php
/**
 * Created by PhpStorm.
 * User: yagishitasho
 * Date: 2018/02/12
 * Time: 13:18
 */

class WasRun {

    /**
     * WasRun constructor.
     * @param $name
     */
    public function __construct($name)
    {
    }
}

$test = new WasRun("testMethod");
print ($test->wasRun);
$test->testMethod();
print ($test->wasRun);