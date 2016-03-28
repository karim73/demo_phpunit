<?php

use Mgl846\Plainte\modele\plainte;

/**
 * Created by PhpStorm.
 * User: karimsafraoui
 * Date: 2016-03-20
 * Time: 23:52
 */


class plainteTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * */
    function getCodePostal()
    {
        $p = new plainte();
        $p->setCodePostal("H1S2N5");
        $this->assertTrue($p->getCodePostal()=="H1S2N5");
    }

//    protected $attributs;
//    /**
//     * @before
//     */
//    function attributs_objets_plainte()
//    {
//        $this->attributs = [
//            'TextPlainte' => "toto titi tata",
//            'NbMois' => 6,
//            'NiveauPlainte' => 2,
//            'CodePostal' => "H1S2N5",
//            'Telephone' => "5141231234",
//            'Email' => "karim_safraoui@etsmtl.ca",
//            'Decision' => "I-D"
//        ];
//    }
//
//    /**
//     * @test
//     */
//    function getterAndSetter()
//    {
//        $p = new plainte();
//
//        foreach($this->attributs as $att => $value){
//
//            $methodeSet = "set".$att;
//            $methodeGet = "get".$att;
//
//            $p->$methodeSet($value);
//            $attendu = $p->$methodeGet();
//
//            $this->assertEquals($attendu,$value);
//        }
//    }
}