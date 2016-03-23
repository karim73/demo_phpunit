<?php

use Mgl846\plainte;
/**
 * Created by PhpStorm.
 * User: karimsafraoui
 * Date: 2016-03-20
 * Time: 23:52
 */
class PlainteTest extends \PHPUnit_Framework_TestCase
{

    function testGetCodePostal()
    {
        $p = new plainte();
        $p->setCodePostal("H1S2N5");
        $this->assertTrue($p->getCodePostal()=="H1S2N5");
    }

}