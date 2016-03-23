<?php

namespace Mgl846;

/**
 * Created by PhpStorm.
 * User: karimsafraoui
 * Date: 2016-03-19
 * Time: 18:38
 */

use \Mgl846\plainte,
    \Mgl846\valider_plainte;

class app
{
    function __construct()
    {
    }

    function process_plainte()
    {

        try{

            $source = $this->get_source();
            $plainte = $this->recuperer_formulaire($source);
            $this->valider_formulaire( $plainte );
            $statut_plainte = $this->statuer_plainte($plainte);

            $this->reponse( true, $statut_plainte );
        }
        catch(\Exception $e){

            $this->reponse( false, $e->getMessage() );
        }
    }

    function valider_formulaire(plainte $plainte)
    {
        $validator = new valider_plainte();

        $error = array();

        $str = $validator->validation_attributs("code_postal" , $plainte->getCodePostal() );
        if(!empty($str)){
            $error[] = $str;
        }

        $str = $validator->validation_attributs("nb_mois" , $plainte->getNbMois() );
        if(!empty($str)){
            $error[] = $str;
        }

        $str = $validator->validation_attributs("niveau_plainte" , $plainte->getNiveauPlainte() );
        if(!empty($str)){
            $error[] = $str;
        }

        $str = $validator->validation_attributs("text_plainte" , $plainte->getTextPlainte() );
        if(!empty($str)){
            $error[] = $str;
        }

        $str = $validator->validation_attributs("telephone" , $plainte->getTelephone() );
        if(!empty($str)){
            $error[] = $str;
        }

        $str = $validator->validation_attributs("email" , $plainte->getEmail() );
        if(!empty($str)){
            $error[] = $str;
        }

        if(count($error) > 0){
            throw new \Exception(implode(", ",$error));
        }
    }

    function get_source()
    {
        $response = file_get_contents('php://input');
        return json_decode($response,true);
    }

    /**
     * @params:
     * $source : array
     * */
    public function recuperer_formulaire($source)
    {
		print "Inside " ;
    	print_r($source);
        $obj = new plainte();

        $obj->setCodePostal( $this->getValue($source,'code_postal') );
        $obj->setNbMois( $this->getValue($source,'nb_mois') );
        $obj->setNiveauPlainte( $this->getValue($source,'niveau_plainte') );
        $obj->setTextPlainte( $this->getValue($source,'text_plainte') );
        $obj->setTelephone( $this->getValue($source,'telephone') );
        $obj->setEmail( $this->getValue($source,'email') );

        return $obj;
    }

    /**
     *
     * 3 Niveaux : Information, Decision, Validation
     * 3 divisions : Agent, Manager, Directeur
     * Niveau-categorie :
     *      I-D : Information, Directeur
     *      D-A : Decision, Agent
     *      V-M : Validation, Manager
     *
     * Par défaut :
     *  D-A : Decision Agent
     *  V-M : Validation Manager
     *
     * Si texte contient poursuite et/ou avocat :
     *      I-D , D-M, V-D
     *
     * Si client < 2 ans :
     *      severité < 3 :
     *          D-A
     *      Sinon :
     *          D-A, V-M
     *
     * Si client > 5 ans :
     *      D-A, I-M, V-M
     *
     * Sinon D-A, V-M
     */
    function statuer_plainte(plainte $plainte)
    {
        $statut_plainte = "";

        if( preg_match( "/(poursuite|avocat)/", $plainte->getTextPlainte()) ){
            $statut_plainte = "I-D, D-M, V-D";
        }
        else if($plainte->getNbMois() < 24){
            if($plainte->getNiveauPlainte() < 3){
                $statut_plainte = "D-A";
            }
            else {
                $statut_plainte = "D-A, V-M";
            }
        }
        else if($plainte->getNbMois() > 60  ){
            $statut_plainte = "D-A, I-M, V-M";
        }
        else{
            $statut_plainte = "D-A, V-M";
        }

        return $statut_plainte;
    }

    function getValue($array,$key){

        return isset($array[$key]) ? $array[$key] : "";
    }

    function reponse($statut,$msg){
        print json_encode(
            array(
                "statut" => $statut == true,
                "msg" => $msg
            ));
    }
}