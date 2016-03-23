<?php
/**
 * Created by PhpStorm.
 * User: karimsafraoui
 * Date: 2016-03-20
 * Time: 15:46
 */

namespace Mgl846;


class valider_plainte
{

    function __construct()
    {
    }

    function validation_attributs($attribut,$value)
    {
        $error = "";

        if(empty($value)){
            $error = "Veuillez fournir l'information suivante : " . $attribut;
            return $error;
        }

        switch($attribut)
        {
            case 'telephone' :
                if(!preg_match("/^[0-9]{10}$/",$value)){
                    $error = "Numero de telephone non valide : " . $value;
                }
                break;

            case 'email' :
                if( ! filter_var($value, FILTER_VALIDATE_EMAIL) ){
                    $error = "E-mail non valide : " . $value;
                }
                break;

            case 'code_postal' :
                if( ! preg_match( "/^([a-zA-Z][1-9]){3}$/" , $value ) ){
                    $error = "E-mail non valide : " . $value;
                }
                break;

            case 'niveau_plainte' :

                if( ! preg_match( "/^[1-5]$/" , $value ) ){
                    $error = "Niveau de plainte invalide : " . $value;
                }
                break;

            case 'text_plainte' :

                if( strlen( $value ) < 15 || str_word_count( $value ) < 5 ){
                    $error = "Texte plainte non concis : " . $value;
                }
                break;

            case 'nb_mois' :

                if( ! preg_match( "/^[1-9][0-9]+$/" , $value ) ){
                    $error = "Nombre de mois invalide : " . $value;
                }
                break;

            default :
                $error = "L'attribut suivant n'est pas attendu ";
        }

        return $error;

    }
}