<?php

namespace Mgl846\Plainte\tools;

/**
 * Created by PhpStorm.
 * User: karimsafraoui
 * Date: 2016-03-20
 * Time: 15:46
 */


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
            /**
             * Telephone format canadien : XXX XXX XXXX (sans espace)
             */
            case 'telephone' :
                if(!preg_match("/^[1-9][0-9]{9}$/",$value)){
                    $error = "Numero de telephone non valide : " . $value;
                }
                break;

            /**
             * E-mail valide
             */
            case 'email' :
                if( ! filter_var($value, FILTER_VALIDATE_EMAIL) ){
                    $error = "E-mail non valide : " . $value;
                }
                break;

            /**
             * code postal format canadien : A1A 1A1 (sans espace)
             */
            case 'code_postal' :
                if( ! preg_match( "/^([a-zA-Z][1-9]){3}$/" , $value ) ){
                    $error = "E-mail non valide : " . $value;
                }
                break;

            /**
             * Niveau compris entre 1 et 5
             */
            case 'niveau_plainte' :

                if( ! preg_match( "/^[1-5]$/" , $value ) ){
                    $error = "Niveau de plainte invalide : " . $value;
                }
                break;

            /**
             * Minimum 5 mots, minimum 15 caracteres
             */
            case 'text_plainte' :

                if( strlen( $value ) < 15 || str_word_count( $value ) < 5 ){
                    $error = "Texte plainte non concis : " . $value;
                }
                break;

            /**
             * nb mois compris entre : 1 mois et 999 mois
             */
            case 'nb_mois' :

                if( ! preg_match( "/^[1-9][0-9]{0,2}$/" , $value ) ){
                    $error = "Nombre de mois invalide : " . $value;
                }
                break;

            default :
                $error = "L'attribut suivant n'est pas attendu ";
        }

        return $error;

    }
}