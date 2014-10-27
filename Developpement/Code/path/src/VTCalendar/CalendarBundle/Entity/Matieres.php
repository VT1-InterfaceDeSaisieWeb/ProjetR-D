<?php

namespace VTCalendar\CalendarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matieres
 *
 * @ORM\Table(name="matieres", indexes={@ORM\Index(name="IDX_matiere_del", columns={"deleted"}), @ORM\Index(name="IDX_matiere_prop", columns={"codeProprietaire"}), @ORM\Index(name="IDX_matiere_dateModif", columns={"dateModif"})})
 * @ORM\Entity
 */
class Matieres
{
    /**
     * @var integer
     *
     * @ORM\Column(name="codeMatiere", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codematiere;

    /**
     * @var integer
     *
     * @ORM\Column(name="couleurFond", type="bigint", nullable=false)
     */
    private $couleurfond = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="couleurPolice", type="bigint", nullable=false)
     */
    private $couleurpolice = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom = 'MATIERE?';

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer", nullable=false)
     */
    private $type = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="codeCNU", type="integer", nullable=false)
     */
    private $codecnu = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=50, nullable=false)
     */
    private $alias = 'MATIERE?';

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
     * @ORM\Column(name="codeProprietaire", type="bigint", nullable=false)
     */
    private $codeproprietaire = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=150, nullable=false)
     */
    private $commentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="identifiant", type="string", length=50, nullable=false)
     */
    private $identifiant;



    /**
     * Get codematiere
     *
     * @return integer 
     */
    public function getCodematiere()
    {
        return $this->codematiere;
    }

    /**
     * Set couleurfond
     *
     * @param integer $couleurfond
     * @return Matieres
     */
    public function setCouleurfond($couleurfond)
    {
        $this->couleurfond = $couleurfond;

        return $this;
    }

    /**
     * Get couleurfond
     *
     * @return integer 
     */
    public function getCouleurfond()
    {
        return $this->couleurfond;
    }

    /**
     * Set couleurpolice
     *
     * @param integer $couleurpolice
     * @return Matieres
     */
    public function setCouleurpolice($couleurpolice)
    {
        $this->couleurpolice = $couleurpolice;

        return $this;
    }

    /**
     * Get couleurpolice
     *
     * @return integer 
     */
    public function getCouleurpolice()
    {
        return $this->couleurpolice;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Matieres
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return Matieres
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set codecnu
     *
     * @param integer $codecnu
     * @return Matieres
     */
    public function setCodecnu($codecnu)
    {
        $this->codecnu = $codecnu;

        return $this;
    }

    /**
     * Get codecnu
     *
     * @return integer 
     */
    public function getCodecnu()
    {
        return $this->codecnu;
    }

    /**
     * Set alias
     *
     * @param string $alias
     * @return Matieres
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string 
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set datemodif
     *
     * @param \DateTime $datemodif
     * @return Matieres
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
     * @return Matieres
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
     * @return Matieres
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
     * @return Matieres
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
     * @return Matieres
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
     * Set identifiant
     *
     * @param string $identifiant
     * @return Matieres
     */
    public function setIdentifiant($identifiant)
    {
        $this->identifiant = $identifiant;

        return $this;
    }

    /**
     * Get identifiant
     *
     * @return string 
     */
    public function getIdentifiant()
    {
        return $this->identifiant;
    }
}
