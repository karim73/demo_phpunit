<?php

use Mgl846\Plainte\controller\app;
use Mgl846\Plainte\modele\plainte;

class appTest extends \PHPUnit_Framework_TestCase
{

    protected $data;
    protected $invalid_data;

    /**
     * @before
     * */
    function initData()
    {

        $this->data = array(
            'nb_mois' => 24,
            'telephone' => '5141234567',
            'email' => 'contact@contact.ca',
            'niveau_plainte' => 4,
            'text_plainte' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua",
            'code_postal' => 'A1A1A1'
        );


        $this->invalid_data = array(
            'nb_mois' => 3100,
            'telephone' => '141234567',
            'email' => 'contact@contactca',
            'niveau_plainte' => 10,
            'text_plainte' => "Lorem ipsum",
            'code_postal' => 'AA1A1'
        );
    }

    /**
     * @test
     * */
    function map_request_to_formulaire()
    {
        $app = new app();
        $plainte = $app->mappper_formulaire_to_objet($this->data);

        $this->assertTrue($this->data['telephone'] == $plainte->getTelephone());
        $this->assertTrue($this->data['code_postal'] == $plainte->getCodePostal());
        $this->assertTrue($this->data['nb_mois'] == $plainte->getNbMois());
        $this->assertTrue($this->data['text_plainte'] == $plainte->getTextPlainte());
        $this->assertTrue($this->data['niveau_plainte'] == $plainte->getNiveauPlainte());
        $this->assertTrue($this->data['email'] == $plainte->getEmail());
    }

    /**
     * @test
     */
    function get_source_donnees_mock()
    {
        $mock_app = $this->getMockBuilder('Mgl846\Plainte\controller\app')
            ->getMock();

        $mock_app->method('get_source_donnees')
            ->will($this->returnArgument(0));

        $p = $mock_app->get_source_donnees($this->data);

        $this->assertEquals($p, $this->data);
    }

    /**
     * @test
     */
    function getValue()
    {
        $app = new app();
        $arg1 = ["key" => "value"];

        $this->assertEquals("value", $app->getValue($arg1, "key"));

        $arg1 = "array";
        $this->assertEquals("", $app->getValue($arg1, "key"));
    }

    /**
     * @test
     */
    function valider_formulaire()
    {
        $app = new app();
        $plainte = $app->mappper_formulaire_to_objet($this->data);
        $app->valider_formulaire($plainte);

        $this->assertTrue(true);
    }

    /**
     * @test
     * @expectedException Exception
     */
    function valider_formulaire_wrong()
    {
        $app = new app();
        $plainte = $app->mappper_formulaire_to_objet($this->invalid_data);
        $app->valider_formulaire($plainte);
    }

    /**
     * @test
     */
    function statuter_plainte_ID_DM_VD()
    {
        $app = new app();
        $this->data['text_plainte'] = "toto titi yaya plainte avocat";
        $plainte = $app->mappper_formulaire_to_objet($this->data);

        $statut = $app->statuer_plainte($plainte);
        $attendu = "I-D, D-M, V-D";

        $this->assertEquals($statut, $attendu);
    }

    /**
     * @test
     */
    function statuter_plainte_DA()
    {
        $app = new app();
        $this->data['nb_mois'] = 23;
        $this->data['niveau_plainte'] = 2;

        $plainte = $app->mappper_formulaire_to_objet($this->data);

        $statut = $app->statuer_plainte($plainte);
        $attendu = "D-A";

        $this->assertEquals($statut, $attendu);
    }

    /**
     * @test
     */
    function statuter_plainte_DA_VM()
    {
        $app = new app();
        $this->data['nb_mois'] = 23;
        $this->data['niveau_plainte'] = 3;

        $plainte = $app->mappper_formulaire_to_objet($this->data);

        $statut = $app->statuer_plainte($plainte);
        $attendu = "D-A, V-M";

        $this->assertEquals($statut, $attendu);
    }

    /**
     * @test
     */
    function statuter_plainte_DA_VM_bis()
    {
        $app = new app();
        $this->data['nb_mois'] = 30;

        $plainte = $app->mappper_formulaire_to_objet($this->data);

        $statut = $app->statuer_plainte($plainte);
        $attendu = "D-A, V-M";

        $this->assertEquals($statut, $attendu);
    }

    /**
     * @test
     */
    function statuter_plainte_DA_IM_VM()
    {
        $app = new app();
        $this->data['nb_mois'] = 65;

        $plainte = $app->mappper_formulaire_to_objet($this->data);

        $statut = $app->statuer_plainte($plainte);
        $attendu = "D-A, I-M, V-M";

        $this->assertEquals($statut, $attendu);
    }

    /**
     * @test
     */
    function processer_plainte()
    {
        $app = new app();
        $app->_source_input = "tests/src/Mgl846/plainte/controller/request.data";
        $app->processer_plainte();

        $this->assertTrue(true);
    }

    /**
     * @test
     * @expectedException Exception
     */
    function processer_plainte_wrong()
    {
        $app = new app();
        $app->_source_input = "tests/src/Mgl846/plainte/controller/invalid_request.data";
        $app->processer_plainte();
    }
}