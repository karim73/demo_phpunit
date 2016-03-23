<?php

use Mgl846\app;

class appTest extends \PHPUnit_Framework_TestCase
{

	protected $data;
	
	/**
	 * @before
	 * */
	function initData()
	{
		$this->data = array(
				'nb_mois'=>24,
				'telephone'=>'5141234567',
				'email'=>'contact@contact.ca',
				'niveau_plainte' => 4,
				'text_plainte'=>'lepsum ops menui plainte avocat',
				'code_postal'=>'A1A1A1'
			); 
	}
		
	/**
	 * @test
	 * */
	function valider_formulaire()
	{
		$plainte_mock = $this->getMockBuilder("Mgl846\plainte")->getMock();
		$this->assertTrue(true);
	}	
	
	/**
	 * @test
	 * */
	function recuperer_formulaire()
	{
		$mock_app = $this->getMockBuilder("Mgl846\app")
                     	->disableOriginalConstructor()
						->getMock();
		
		$mock_app->method('recuperer_formulaire')
				->will($this->returnArgument(0));
		
		$p = $mock_app->recuperer_formulaire($this->data);
		
		printf("Detail<pre>%s</pre>",print_r($p,1));
	}
}