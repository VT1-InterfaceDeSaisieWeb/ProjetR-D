<?php

namespace VTCalendar\CalendarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seances
 *
 * @ORM\Table(name="seances", indexes={@ORM\Index(name="IDX_plan_codeEns", columns={"codeEnseignement"}), @ORM\Index(name="IDX_plan_date", columns={"dateSeance"}), @ORM\Index(name="IDX_plan_del", columns={"deleted"}), @ORM\Index(name="IDX_plan_prop", columns={"codeProprietaire"}), @ORM\Index(name="IDX_plan_dateModif", columns={"dateModif"})})
 * @ORM\Entity
 */
class Seances
{
    /**
     * @var integer
     *
     * @ORM\Column(name="codeSeance", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeseance;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateSeance", type="date", nullable=false)
     */
    private $dateseance = '0000-00-00';

    /**
     * @var integer
     *
     * @ORM\Column(name="heureSeance", type="integer", nullable=false)
     */
    private $heureseance = '800';

    /**
     * @var integer
     *
     * @ORM\Column(name="dureeSeance", type="integer", nullable=false)
     */
    private $dureeseance = '100';

    /**
     * @var integer
     *
     * @ORM\Column(name="codeEnseignement", type="integer", nullable=false)
     */
    private $codeenseignement = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateModif", type="datetime", nullable=false)
     */
    private $datemodif = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime", nullable=false)
     */
    private $datecreation;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deleted", type="boolean", nullable=false)
     */
    private $deleted = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="codeProprietaire", type="integer", nullable=false)
     */
    private $codeproprietaire = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=200, nullable=false)
     */
    private $commentaire = '';

    /**
     * @var boolean
     *
     * @ORM\Column(name="bloquee", type="boolean", nullable=false)
     */
    private $bloquee = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="diffusable", type="boolean", nullable=false)
     */
    private $diffusable = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="annulee", type="boolean", nullable=false)
     */
    private $annulee = '0';



    /**
     * Get codeseance
     *
     * @return integer 
     */
    public function getCodeseance()
    {
        return $this->codeseance;
    }

    /**
     * Set dateseance
     *
     * @param \DateTime $dateseance
     * @return Seances
     */
    public function setDateseance($dateseance)
    {
        $this->dateseance = $dateseance;

        return $this;
    }

    /**
     * Get dateseance
     *
     * @return \DateTime 
     */
    public function getDateseance()
    {
        return $this->dateseance;
    }

    /**
     * Set heureseance
     *
     * @param integer $heureseance
     * @return Seances
     */
    public function setHeureseance($heureseance)
    {
        $this->heureseance = $heureseance;

        return $this;
    }

    /**
     * Get heureseance
     *
     * @return integer 
     */
    public function getHeureseance()
    {
        return $this->heureseance;
    }

    /**
     * Set dureeseance
     *
     * @param integer $dureeseance
     * @return Seances
     */
    public function setDureeseance($dureeseance)
    {
        $this->dureeseance = $dureeseance;

        return $this;
    }

    /**
     * Get dureeseance
     *
     * @return integer 
     */
    public function getDureeseance()
    {
        return $this->dureeseance;
    }

    /**
     * Set codeenseignement
     *
     * @param integer $codeenseignement
     * @return Seances
     */
    public function setCodeenseignement($codeenseignement)
    {
        $this->codeenseignement = $codeenseignement;

        return $this;
    }

    /**
     * Get codeenseignement
     *
     * @return integer 
     */
    public function getCodeenseignement()
    {
        return $this->codeenseignement;
    }

    /**
     * Set datemodif
     *
     * @param \DateTime $datemodif
     * @return Seances
     */
    public function setDatemodif($datemodif)
    {
        $this->datemodif = $datemodif;

        return $this;
    }

    /**
     * Get datemodif
     *
     * @return \DateTime 
     */
    public function getDatemodif()
    {
        return $this->datemodif;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     * @return Seances
     */
    public function setDatecreation($datecreation)
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    /**
     * Get datecreation
     *
     * @return \DateTime 
     */
    public function getDatecreation()
    {
        return $this->datecreation;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return Seances
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean 
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set codeproprietaire
     *
     * @param integer $codeproprietaire
     * @return Seances
     */
    public function setCodeproprietaire($codeproprietaire)
    {
        $this->codeproprietaire = $codeproprietaire;

        return $this;
    }

    /**
     * Get codeproprietaire
     *
     * @return integer 
     */
    public function getCodeproprietaire()
    {
        return $this->codeproprietaire;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return Seances
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string 
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set bloquee
     *
     * @param boolean $bloquee
     * @return Seances
     */
    public function setBloquee($bloquee)
    {
        $this->bloquee = $bloquee;

        return $this;
    }

    /**
     * Get bloquee
     *
     * @return boolean 
     */
    public function getBloquee()
    {
        return $this->bloquee;
    }

    /**
     * Set diffusable
     *
     * @param boolean $diffusable
     * @return Seances
     */
    public function setDiffusable($diffusable)
    {
        $this->diffusable = $diffusable;

        return $this;
    }

    /**
     * Get diffusable
     *
     * @return boolean 
     */
    public function getDiffusable()
    {
        return $this->diffusable;
    }

    /**
     * Set annulee
     *
     * @param boolean $annulee
     * @return Seances
     */
    public function setAnnulee($annulee)
    {
        $this->annulee = $annulee;

        return $this;
    }

    /**
     * Get annulee
     *
     * @return boolean 
     */
    public function getAnnulee()
    {
        return $this->annulee;
    }
}
