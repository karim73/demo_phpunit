<?php
/**
 * Created by PhpStorm.
 * User: karimsafraoui
 * Date: 2016-03-19
 * Time: 14:05
 */

namespace Mgl846\Plainte\modele;


class plainte
{

    private $text_plainte;
    private $nb_mois;
    private $niveau_plainte;
    private $code_postal;
    private $telephone;
    private $email;
    private $decision;

    function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getTextPlainte()
    {
        return $this->text_plainte;
    }

    /**
     * @param mixed $text_plainte
     */
    public function setTextPlainte($text_plainte)
    {
        $this->text_plainte = $text_plainte;
    }

    /**
     * @return mixed
     */
    public function getNbMois()
    {
        return $this->nb_mois;
    }

    /**
     * @param mixed $nb_mois
     */
    public function setNbMois($nb_mois)
    {
        $this->nb_mois = $nb_mois;
    }

    /**
     * @return mixed
     */
    public function getNiveauPlainte()
    {
        return $this->niveau_plainte;
    }

    /**
     * @param mixed $niveau_plainte
     */
    public function setNiveauPlainte($niveau_plainte)
    {
        $this->niveau_plainte = $niveau_plainte;
    }

    /**
     * @return mixed
     */
    public function getCodePostal()
    {
        return $this->code_postal;
    }

    /**
     * @param mixed $code_postal
     */
    public function setCodePostal($code_postal)
    {
        $this->code_postal = $code_postal;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getDecision()
    {
        return $this->decision;
    }

    /**
     * @param mixed $decision
     */
    public function setDecision($decision)
    {
        $this->decision = $decision;
    }
}