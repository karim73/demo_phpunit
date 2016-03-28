<?php
//
//use Mgl846\Plainte\tools\valider_plainte;
//
///**
// * Created by PhpStorm.
// * User: karimsafraoui
// * Date: 2016-03-20
// * Time: 23:55
// */
//
//class valider_plainteTest extends \PHPUnit_Framework_TestCase
//{
//
//	/**
//	 * @test
//	 * */
//    function assertTrueCodePostal()
//    {
//        $code_postal="H1S2N5";
//        $valid = new valider_plainte();
//		$test = $valid->validation_attributs("code_postal",$code_postal);
//
//        $this->assertEquals($test,"");
//    }
//
////    protected $config_empty = array();
////    protected $config_true = array();
////    protected $config_false = array();
////    protected $config_wrong_attribute = array();
////    protected $validator;
////    /**
////     * @before
////     */
////    function config_test()
////    {
////        $this->validator = new valider_plainte();
////
////        $this->config_empty = [
////            'telephone' => "",
////            'email' => "",
////            'code_postal' => "",
////            'niveau_plainte' => "",
////            'text_plainte' => "",
////            'nb_mois' => "",
////        ];
////
////        $this->config_true = [
////            'telephone' => "5141231234",
////            'email' => "karim.safraoui@etsmtl.ca",
////            'code_postal' => "H1H1N1",
////            'niveau_plainte' => 4,
////            'text_plainte' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua",
////            'nb_mois' => 23,
////        ];
////
////        $this->config_false = [
////            'telephone' => "012878298272",
////            'email' => "karim.safraoui@etsmtlca",
////            'code_postal' => "28173",
////            'niveau_plainte' => 6,
////            'text_plainte' => "toto titi tata",
////            'nb_mois' => "24 mois",
////        ];
////
////        $this->config_wrong_attribute = [
////            'telephones' => "012878298272",
////            'emails' => "karim.safraoui@etsmtlca",
////            'code_postals' => "28173",
////            'niveau_plaintes' => 6,
////            'text_plaintes' => "toto titi tata",
////            'nb_moiss' => "24 mois",
////        ];
////    }
////
////    /**
////     * @test
////     * */
////    function assertConfigTrue()
////    {
////
////        foreach($this->config_true as $att => $value)
////        {
////            $test = $this->validator->validation_attributs($att,$value);
////            $this->assertEmpty($test);
////        }
////    }
////
////    /**
////     * @test
////     * */
////    function assertConfigFalse()
////    {
////
////        foreach($this->config_false as $att => $value)
////        {
////            $test = $this->validator->validation_attributs($att,$value);
////            $this->assertNotEmpty($test);
////        }
////    }
////
////    /**
////     * @test
////     * */
////    function assertConfigEmpty()
////    {
////
////        foreach($this->config_empty as $att => $value)
////        {
////            $test = $this->validator->validation_attributs($att,$value);
////            $this->assertNotEmpty($test);
////        }
////    }
////
////    /**
////     * @test
////     * */
////    function assertConfigWrongAttribute()
////    {
////        foreach($this->config_wrong_attribute as $att => $value)
////        {
////            $test = $this->validator->validation_attributs($att,$value);
////            $this->assertNotEmpty($test);
////        }
////    }
//}