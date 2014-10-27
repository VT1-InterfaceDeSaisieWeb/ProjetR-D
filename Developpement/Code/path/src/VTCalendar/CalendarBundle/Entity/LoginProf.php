<?php

namespace VTCalendar\CalendarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LoginProf
 *
 * @ORM\Table(name="login_prof")
 * @ORM\Entity
 */
class LoginProf
{
    /**
     * @var integer
     *
     * @ORM\Column(name="codeProf", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeprof;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=60, nullable=true)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="motPasse", type="string", length=60, nullable=true)
     */
    private $motpasse;

    /**
     * @var integer
     *
     * @ORM\Column(name="horizontal", type="integer", nullable=true)
     */
    private $horizontal = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="selecGroupe", type="string", length=60, nullable=true)
     */
    private $selecgroupe;

    /**
     * @var string
     *
     * @ORM\Column(name="selecProf", type="string", length=60, nullable=true)
     */
    private $selecprof;

    /**
     * @var string
     *
     * @ORM\Column(name="selecSalle", type="string", length=60, nullable=true)
     */
    private $selecsalle;

    /**
     * @var string
     *
     * @ORM\Column(name="selecMateriel", type="string", length=60, nullable=true)
     */
    private $selecmateriel;

    /**
     * @var integer
     *
     * @ORM\Column(name="weekend", type="integer", nullable=true)
     */
    private $weekend = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="couleur_groupe", type="integer", nullable=true)
     */
    private $couleurGroupe = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="couleur_prof", type="integer", nullable=true)
     */
    private $couleurProf = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="couleur_salle", type="integer", nullable=true)
     */
    private $couleurSalle = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="couleur_materiel", type="integer", nullable=true)
     */
    private $couleurMateriel = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="heureDebut", type="float", precision=10, scale=0, nullable=true)
     */
    private $heuredebut = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="heureFin", type="float", precision=10, scale=0, nullable=true)
     */
    private $heurefin = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="bouton1Debut", type="float", precision=10, scale=0, nullable=true)
     */
    private $bouton1debut = '8';

    /**
     * @var float
     *
     * @ORM\Column(name="bouton1Fin", type="float", precision=10, scale=0, nullable=true)
     */
    private $bouton1fin = '10';

    /**
     * @var float
     *
     * @ORM\Column(name="bouton2Debut", type="float", precision=10, scale=0, nullable=true)
     */
    private $bouton2debut = '10';

    /**
     * @var float
     *
     * @ORM\Column(name="bouton2Fin", type="float", precision=10, scale=0, nullable=true)
     */
    private $bouton2fin = '12';

    /**
     * @var float
     *
     * @ORM\Column(name="bouton3Debut", type="float", precision=10, scale=0, nullable=true)
     */
    private $bouton3debut = '14';

    /**
     * @var float
     *
     * @ORM\Column(name="bouton3Fin", type="float", precision=10, scale=0, nullable=true)
     */
    private $bouton3fin = '16';

    /**
     * @var float
     *
     * @ORM\Column(name="bouton4Debut", type="float", precision=10, scale=0, nullable=true)
     */
    private $bouton4debut = '16';

    /**
     * @var float
     *
     * @ORM\Column(name="bouton4Fin", type="float", precision=10, scale=0, nullable=true)
     */
    private $bouton4fin = '18';

    /**
     * @var integer
     *
     * @ORM\Column(name="reservation", type="integer", nullable=true)
     */
    private $reservation = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="module", type="integer", nullable=true)
     */
    private $module = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="bilan_heure", type="integer", nullable=true)
     */
    private $bilanHeure = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="configuration", type="integer", nullable=true)
     */
    private $configuration = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="rss", type="integer", nullable=true)
     */
    private $rss = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="bilan_heure_global", type="integer", nullable=true)
     */
    private $bilanHeureGlobal = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="bilan_formation", type="integer", nullable=true)
     */
    private $bilanFormation = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="pdf", type="integer", nullable=true)
     */
    private $pdf = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="seance_clicable", type="integer", nullable=true)
     */
    private $seanceClicable = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="giseh", type="integer", nullable=true)
     */
    private $giseh = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="salle", type="integer", nullable=true)
     */
    private $salle = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="mes_droits", type="integer", nullable=true)
     */
    private $mesDroits = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="admin", type="integer", nullable=true)
     */
    private $admin = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="dialogue", type="integer", nullable=true)
     */
    private $dialogue = '0';



    /**
     * Get codeprof
     *
     * @return integer 
     */
    public function getCodeprof()
    {
        return $this->codeprof;
    }

    /**
     * Set login
     *
     * @param string $login
     * @return LoginProf
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set motpasse
     *
     * @param string $motpasse
     * @return LoginProf
     */
    public function setMotpasse($motpasse)
    {
        $this->motpasse = $motpasse;

        return $this;
    }

    /**
     * Get motpasse
     *
     * @return string 
     */
    public function getMotpasse()
    {
        return $this->motpasse;
    }

    /**
     * Set horizontal
     *
     * @param integer $horizontal
     * @return LoginProf
     */
    public function setHorizontal($horizontal)
    {
        $this->horizontal = $horizontal;

        return $this;
    }

    /**
     * Get horizontal
     *
     * @return integer 
     */
    public function getHorizontal()
    {
        return $this->horizontal;
    }

    /**
     * Set selecgroupe
     *
     * @param string $selecgroupe
     * @return LoginProf
     */
    public function setSelecgroupe($selecgroupe)
    {
        $this->selecgroupe = $selecgroupe;

        return $this;
    }

    /**
     * Get selecgroupe
     *
     * @return string 
     */
    public function getSelecgroupe()
    {
        return $this->selecgroupe;
    }

    /**
     * Set selecprof
     *
     * @param string $selecprof
     * @return LoginProf
     */
    public function setSelecprof($selecprof)
    {
        $this->selecprof = $selecprof;

        return $this;
    }

    /**
     * Get selecprof
     *
     * @return string 
     */
    public function getSelecprof()
    {
        return $this->selecprof;
    }

    /**
     * Set selecsalle
     *
     * @param string $selecsalle
     * @return LoginProf
     */
    public function setSelecsalle($selecsalle)
    {
        $this->selecsalle = $selecsalle;

        return $this;
    }

    /**
     * Get selecsalle
     *
     * @return string 
     */
    public function getSelecsalle()
    {
        return $this->selecsalle;
    }

    /**
     * Set selecmateriel
     *
     * @param string $selecmateriel
     * @return LoginProf
     */
    public function setSelecmateriel($selecmateriel)
    {
        $this->selecmateriel = $selecmateriel;

        return $this;
    }

    /**
     * Get selecmateriel
     *
     * @return string 
     */
    public function getSelecmateriel()
    {
        return $this->selecmateriel;
    }

    /**
     * Set weekend
     *
     * @param integer $weekend
     * @return LoginProf
     */
    public function setWeekend($weekend)
    {
        $this->weekend = $weekend;

        return $this;
    }

    /**
     * Get weekend
     *
     * @return integer 
     */
    public function getWeekend()
    {
        return $this->weekend;
    }

    /**
     * Set couleurGroupe
     *
     * @param integer $couleurGroupe
     * @return LoginProf
     */
    public function setCouleurGroupe($couleurGroupe)
    {
        $this->couleurGroupe = $couleurGroupe;

        return $this;
    }

    /**
     * Get couleurGroupe
     *
     * @return integer 
     */
    public function getCouleurGroupe()
    {
        return $this->couleurGroupe;
    }

    /**
     * Set couleurProf
     *
     * @param integer $couleurProf
     * @return LoginProf
     */
    public function setCouleurProf($couleurProf)
    {
        $this->couleurProf = $couleurProf;

        return $this;
    }

    /**
     * Get couleurProf
     *
     * @return integer 
     */
    public function getCouleurProf()
    {
        return $this->couleurProf;
    }

    /**
     * Set couleurSalle
     *
     * @param integer $couleurSalle
     * @return LoginProf
     */
    public function setCouleurSalle($couleurSalle)
    {
        $this->couleurSalle = $couleurSalle;

        return $this;
    }

    /**
     * Get couleurSalle
     *
     * @return integer 
     */
    public function getCouleurSalle()
    {
        return $this->couleurSalle;
    }

    /**
     * Set couleurMateriel
     *
     * @param integer $couleurMateriel
     * @return LoginProf
     */
    public function setCouleurMateriel($couleurMateriel)
    {
        $this->couleurMateriel = $couleurMateriel;

        return $this;
    }

    /**
     * Get couleurMateriel
     *
     * @return integer 
     */
    public function getCouleurMateriel()
    {
        return $this->couleurMateriel;
    }

    /**
     * Set heuredebut
     *
     * @param float $heuredebut
     * @return LoginProf
     */
    public function setHeuredebut($heuredebut)
    {
        $this->heuredebut = $heuredebut;

        return $this;
    }

    /**
     * Get heuredebut
     *
     * @return float 
     */
    public function getHeuredebut()
    {
        return $this->heuredebut;
    }

    /**
     * Set heurefin
     *
     * @param float $heurefin
     * @return LoginProf
     */
    public function setHeurefin($heurefin)
    {
        $this->heurefin = $heurefin;

        return $this;
    }

    /**
     * Get heurefin
     *
     * @return float 
     */
    public function getHeurefin()
    {
        return $this->heurefin;
    }

    /**
     * Set bouton1debut
     *
     * @param float $bouton1debut
     * @return LoginProf
     */
    public function setBouton1debut($bouton1debut)
    {
        $this->bouton1debut = $bouton1debut;

        return $this;
    }

    /**
     * Get bouton1debut
     *
     * @return float 
     */
    public function getBouton1debut()
    {
        return $this->bouton1debut;
    }

    /**
     * Set bouton1fin
     *
     * @param float $bouton1fin
     * @return LoginProf
     */
    public function setBouton1fin($bouton1fin)
    {
        $this->bouton1fin = $bouton1fin;

        return $this;
    }

    /**
     * Get bouton1fin
     *
     * @return float 
     */
    public function getBouton1fin()
    {
        return $this->bouton1fin;
    }

    /**
     * Set bouton2debut
     *
     * @param float $bouton2debut
     * @return LoginProf
     */
    public function setBouton2debut($bouton2debut)
    {
        $this->bouton2debut = $bouton2debut;

        return $this;
    }

    /**
     * Get bouton2debut
     *
     * @return float 
     */
    public function getBouton2debut()
    {
        return $this->bouton2debut;
    }

    /**
     * Set bouton2fin
     *
     * @param float $bouton2fin
     * @return LoginProf
     */
    public function setBouton2fin($bouton2fin)
    {
        $this->bouton2fin = $bouton2fin;

        return $this;
    }

    /**
     * Get bouton2fin
     *
     * @return float 
     */
    public function getBouton2fin()
    {
        return $this->bouton2fin;
    }

    /**
     * Set bouton3debut
     *
     * @param float $bouton3debut
     * @return LoginProf
     */
    public function setBouton3debut($bouton3debut)
    {
        $this->bouton3debut = $bouton3debut;

        return $this;
    }

    /**
     * Get bouton3debut
     *
     * @return float 
     */
    public function getBouton3debut()
    {
        return $this->bouton3debut;
    }

    /**
     * Set bouton3fin
     *
     * @param float $bouton3fin
     * @return LoginProf
     */
    public function setBouton3fin($bouton3fin)
    {
        $this->bouton3fin = $bouton3fin;

        return $this;
    }

    /**
     * Get bouton3fin
     *
     * @return float 
     */
    public function getBouton3fin()
    {
        return $this->bouton3fin;
    }

    /**
     * Set bouton4debut
     *
     * @param float $bouton4debut
     * @return LoginProf
     */
    public function setBouton4debut($bouton4debut)
    {
        $this->bouton4debut = $bouton4debut;

        return $this;
    }

    /**
     * Get bouton4debut
     *
     * @return float 
     */
    public function getBouton4debut()
    {
        return $this->bouton4debut;
    }

    /**
     * Set bouton4fin
     *
     * @param float $bouton4fin
     * @return LoginProf
     */
    public function setBouton4fin($bouton4fin)
    {
        $this->bouton4fin = $bouton4fin;

        return $this;
    }

    /**
     * Get bouton4fin
     *
     * @return float 
     */
    public function getBouton4fin()
    {
        return $this->bouton4fin;
    }

    /**
     * Set reservation
     *
     * @param integer $reservation
     * @return LoginProf
     */
    public function setReservation($reservation)
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * Get reservation
     *
     * @return integer 
     */
    public function getReservation()
    {
        return $this->reservation;
    }

    /**
     * Set module
     *
     * @param integer $module
     * @return LoginProf
     */
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return integer 
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set bilanHeure
     *
     * @param integer $bilanHeure
     * @return LoginProf
     */
    public function setBilanHeure($bilanHeure)
    {
        $this->bilanHeure = $bilanHeure;

        return $this;
    }

    /**
     * Get bilanHeure
     *
     * @return integer 
     */
    public function getBilanHeure()
    {
        return $this->bilanHeure;
    }

    /**
     * Set configuration
     *
     * @param integer $configuration
     * @return LoginProf
     */
    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;

        return $this;
    }

    /**
     * Get configuration
     *
     * @return integer 
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * Set rss
     *
     * @param integer $rss
     * @return LoginProf
     */
    public function setRss($rss)
    {
        $this->rss = $rss;

        return $this;
    }

    /**
     * Get rss
     *
     * @return integer 
     */
    public function getRss()
    {
        return $this->rss;
    }

    /**
     * Set bilanHeureGlobal
     *
     * @param integer $bilanHeureGlobal
     * @return LoginProf
     */
    public function setBilanHeureGlobal($bilanHeureGlobal)
    {
        $this->bilanHeureGlobal = $bilanHeureGlobal;

        return $this;
    }

    /**
     * Get bilanHeureGlobal
     *
     * @return integer 
     */
    public function getBilanHeureGlobal()
    {
        return $this->bilanHeureGlobal;
    }

    /**
     * Set bilanFormation
     *
     * @param integer $bilanFormation
     * @return LoginProf
     */
    public function setBilanFormation($bilanFormation)
    {
        $this->bilanFormation = $bilanFormation;

        return $this;
    }

    /**
     * Get bilanFormation
     *
     * @return integer 
     */
    public function getBilanFormation()
    {
        return $this->bilanFormation;
    }

    /**
     * Set pdf
     *
     * @param integer $pdf
     * @return LoginProf
     */
    public function setPdf($pdf)
    {
        $this->pdf = $pdf;

        return $this;
    }

    /**
     * Get pdf
     *
     * @return integer 
     */
    public function getPdf()
    {
        return $this->pdf;
    }

    /**
     * Set seanceClicable
     *
     * @param integer $seanceClicable
     * @return LoginProf
     */
    public function setSeanceClicable($seanceClicable)
    {
        $this->seanceClicable = $seanceClicable;

        return $this;
    }

    /**
     * Get seanceClicable
     *
     * @return integer 
     */
    public function getSeanceClicable()
    {
        return $this->seanceClicable;
    }

    /**
     * Set giseh
     *
     * @param integer $giseh
     * @return LoginProf
     */
    public function setGiseh($giseh)
    {
        $this->giseh = $giseh;

        return $this;
    }

    /**
     * Get giseh
     *
     * @return integer 
     */
    public function getGiseh()
    {
        return $this->giseh;
    }

    /**
     * Set salle
     *
     * @param integer $salle
     * @return LoginProf
     */
    public function setSalle($salle)
    {
        $this->salle = $salle;

        return $this;
    }

    /**
     * Get salle
     *
     * @return integer 
     */
    public function getSalle()
    {
        return $this->salle;
    }

    /**
     * Set mesDroits
     *
     * @param integer $mesDroits
     * @return LoginProf
     */
    public function setMesDroits($mesDroits)
    {
        $this->mesDroits = $mesDroits;

        return $this;
    }

    /**
     * Get mesDroits
     *
     * @return integer 
     */
    public function getMesDroits()
    {
        return $this->mesDroits;
    }

    /**
     * Set admin
     *
     * @param integer $admin
     * @return LoginProf
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Get admin
     *
     * @return integer 
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Set dialogue
     *
     * @param integer $dialogue
     * @return LoginProf
     */
    public function setDialogue($dialogue)
    {
        $this->dialogue = $dialogue;

        return $this;
    }

    /**
     * Get dialogue
     *
     * @return integer 
     */
    public function getDialogue()
    {
        return $this->dialogue;
    }
}
