<?php

use Mgl846\valider_plainte;

/**
 * Created by PhpStorm.
 * User: karimsafraoui
 * Date: 2016-03-20
 * Time: 23:55
 */
class valider_plainteTest extends \PHPUnit_Framework_TestCase
{
	
	/**
	 * @test
	 * */
    function testAssertTrueCodePostal()
    {
        $code_postal="H1S2N5";
        $valid = new valider_plainte();
		$test = $valid->validation_attributs("code_postal",$code_postal);
        
        $this->assertEquals($test,"");
    }
}