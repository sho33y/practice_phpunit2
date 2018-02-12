<?php
/**
 * Created by PhpStorm.
 * User: yagishitasho
 * Date: 2018/02/12
 * Time: 13:18
 */

$test = new WasRun("testMethod");
print ($test->wasRun);
$test->testMethod();
print ($test->wasRun);