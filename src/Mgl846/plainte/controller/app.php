<?php

namespace Mgl846\Plainte\controller;

/**
 * Created by PhpStorm.
 * User: karimsafraoui
 * Date: 2016-03-19
 * Time: 18:38
 */

use Mgl846\Plainte\tools\valider_plainte,
    Mgl846\Plainte\modele\plainte;

class app
{
    public $_source_input = "php://input";

    function __construct()
    {
    }

    function processer_plainte()
    {

        try{

            $source = $this->get_source_donnees();
            $plainte = $this->mappper_formulaire_to_objet($source);
            $this->valider_formulaire( $plainte );
            $statut_plainte = $this->statuer_plainte($plainte);

            return $this->reponse( true, $statut_plainte );
        }
        catch(\Exception $e){

            return $this->reponse( false, $e->getMessage() );
        }
    }

    /**
     * @param plainte $plainte
     * @throws \Exception
     * Valider les valeurs de chaque attribut de la plainte telle qu'envoyés par l'utilisateur
     */
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

    /**
     * @return mixed
     * retourne un tableau associatif contenant les champs du formulaire
     */
    function get_source_donnees()
    {
        $response = file_get_contents($this->_source_input);
        return json_decode($response,true);
    }

    /**
     * @params:
     * $source : array : données envoyées par le client
     * return : objet de type plainte
     * */
    public function mappper_formulaire_to_objet($source)
    {
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
     * Implémentation de la logique de traitement de la plainte.
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
        else if( $plainte->getNbMois() < 24 ){
            if( $plainte->getNiveauPlainte() < 3 ){
                $statut_plainte = "D-A";
            }
            else {
                $statut_plainte = "D-A, V-M";
            }
        }
        else if( $plainte->getNbMois() > 60 ){
            $statut_plainte = "D-A, I-M, V-M";
        }
        else{
            $statut_plainte = "D-A, V-M";
        }

        return $statut_plainte;
    }

    /**
     * @param $array
     * @param $key
     * @return string
     *
     * Recupere $key dans le tableau $array, et retourne sa $value, string vide sinon
     */
    function getValue( $array , $key ){

        if(is_array($array) ){
            return isset($array[$key]) ? $array[$key] : "";
        }
        return "";
    }

    /**
     * @param $statut
     * @param $msg
     * @return objet_json
     * retourne un objet json, lequel sera la reponse a la requete Ajax
     * format : statut : true ou false si requete bien executée
     *          msg : message pertinent si besoin
     */
    function reponse($statut,$msg){
        json_encode(
            array(
                "statut" => $statut == true,
                "msg" => $msg
            ));
    }
}