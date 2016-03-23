<?php

/**
 * Created by PhpStorm.
 * User: karimsafraoui
 * Date: 2016-03-20
 * Time: 23:13
 */
class test1 extends \PHPUnit_Framework_TestCase
{


    public function testIsTrue()
    {
        $bool = true;
        $this->assertTrue($bool);
    }
}