<?php

namespace VTCalendar\CalendarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Enseignements
 *
 * @ORM\Table(name="enseignements", indexes={@ORM\Index(name="IDX_ens_del", columns={"deleted"}), @ORM\Index(name="IDX_ens_prop", columns={"codeProprietaire"}), @ORM\Index(name="IDX_ens_dateModif", columns={"dateModif"})})
 * @ORM\Entity
 */
class Enseignements
{
    /**
     * @var integer
     *
     * @ORM\Column(name="codeEnseignement", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeenseignement;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=150, nullable=false)
     */
    private $nom = 'ENS?';

    /**
     * @var integer
     *
     * @ORM\Column(name="codeMatiere", type="integer", nullable=false)
     */
    private $codematiere = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="dureeTotale", type="integer", nullable=false)
     */
    private $dureetotale = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="dureeSeance", type="integer", nullable=false)
     */
    private $dureeseance = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="couleurFond", type="integer", nullable=false)
     */
    private $couleurfond = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="couleurPolice", type="integer", nullable=false)
     */
    private $couleurpolice = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=50, nullable=false)
     */
    private $alias = 'ENS?';

    /**
     * @var integer
     *
     * @ORM\Column(name="codeTypeSalle", type="integer", nullable=false)
     */
    private $codetypesalle = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="codeZoneSalle", type="integer", nullable=false)
     */
    private $codezonesalle = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="nbSeancesHebdo", type="integer", nullable=false)
     */
    private $nbseanceshebdo = '0';

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
     * @var boolean
     *
     * @ORM\Column(name="typePublic", type="boolean", nullable=false)
     */
    private $typepublic = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="forfaitaire", type="boolean", nullable=false)
     */
    private $forfaitaire = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="dureeForfaitaire", type="integer", nullable=false)
     */
    private $dureeforfaitaire = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="volumeReparti", type="integer", nullable=false)
     */
    private $volumereparti = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="codeTypeActivite", type="integer", nullable=false)
     */
    private $codetypeactivite = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="codeComposante", type="integer", nullable=false)
     */
    private $codecomposante = '-1';

    /**
     * @var integer
     *
     * @ORM\Column(name="codeNiveau", type="integer", nullable=false)
     */
    private $codeniveau;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="date", nullable=false)
     */
    private $datedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="date", nullable=false)
     */
    private $datefin;

    /**
     * @var boolean
     *
     * @ORM\Column(name="article6", type="boolean", nullable=false)
     */
    private $article6 = '0';



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
     * Set nom
     *
     * @param string $nom
     * @return Enseignements
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
     * Set codematiere
     *
     * @param integer $codematiere
     * @return Enseignements
     */
    public function setCodematiere($codematiere)
    {
        $this->codematiere = $codematiere;

        return $this;
    }

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
     * Set dureetotale
     *
     * @param integer $dureetotale
     * @return Enseignements
     */
    public function setDureetotale($dureetotale)
    {
        $this->dureetotale = $dureetotale;

        return $this;
    }

    /**
     * Get dureetotale
     *
     * @return integer 
     */
    public function getDureetotale()
    {
        return $this->dureetotale;
    }

    /**
     * Set dureeseance
     *
     * @param integer $dureeseance
     * @return Enseignements
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
     * Set couleurfond
     *
     * @param integer $couleurfond
     * @return Enseignements
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
     * @return Enseignements
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
     * Set alias
     *
     * @param string $alias
     * @return Enseignements
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
     * Set codetypesalle
     *
     * @param integer $codetypesalle
     * @return Enseignements
     */
    public function setCodetypesalle($codetypesalle)
    {
        $this->codetypesalle = $codetypesalle;

        return $this;
    }

    /**
     * Get codetypesalle
     *
     * @return integer 
     */
    public function getCodetypesalle()
    {
        return $this->codetypesalle;
    }

    /**
     * Set codezonesalle
     *
     * @param integer $codezonesalle
     * @return Enseignements
     */
    public function setCodezonesalle($codezonesalle)
    {
        $this->codezonesalle = $codezonesalle;

        return $this;
    }

    /**
     * Get codezonesalle
     *
     * @return integer 
     */
    public function getCodezonesalle()
    {
        return $this->codezonesalle;
    }

    /**
     * Set nbseanceshebdo
     *
     * @param integer $nbseanceshebdo
     * @return Enseignements
     */
    public function setNbseanceshebdo($nbseanceshebdo)
    {
        $this->nbseanceshebdo = $nbseanceshebdo;

        return $this;
    }

    /**
     * Get nbseanceshebdo
     *
     * @return integer 
     */
    public function getNbseanceshebdo()
    {
        return $this->nbseanceshebdo;
    }

    /**
     * Set datemodif
     *
     * @param \DateTime $datemodif
     * @return Enseignements
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
     * @return Enseignements
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
     * @return Enseignements
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
     * @return Enseignements
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
     * @return Enseignements
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
     * @return Enseignements
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

    /**
     * Set typepublic
     *
     * @param boolean $typepublic
     * @return Enseignements
     */
    public function setTypepublic($typepublic)
    {
        $this->typepublic = $typepublic;

        return $this;
    }

    /**
     * Get typepublic
     *
     * @return boolean 
     */
    public function getTypepublic()
    {
        return $this->typepublic;
    }

    /**
     * Set forfaitaire
     *
     * @param boolean $forfaitaire
     * @return Enseignements
     */
    public function setForfaitaire($forfaitaire)
    {
        $this->forfaitaire = $forfaitaire;

        return $this;
    }

    /**
     * Get forfaitaire
     *
     * @return boolean 
     */
    public function getForfaitaire()
    {
        return $this->forfaitaire;
    }

    /**
     * Set dureeforfaitaire
     *
     * @param integer $dureeforfaitaire
     * @return Enseignements
     */
    public function setDureeforfaitaire($dureeforfaitaire)
    {
        $this->dureeforfaitaire = $dureeforfaitaire;

        return $this;
    }

    /**
     * Get dureeforfaitaire
     *
     * @return integer 
     */
    public function getDureeforfaitaire()
    {
        return $this->dureeforfaitaire;
    }

    /**
     * Set volumereparti
     *
     * @param integer $volumereparti
     * @return Enseignements
     */
    public function setVolumereparti($volumereparti)
    {
        $this->volumereparti = $volumereparti;

        return $this;
    }

    /**
     * Get volumereparti
     *
     * @return integer 
     */
    public function getVolumereparti()
    {
        return $this->volumereparti;
    }

    /**
     * Set codetypeactivite
     *
     * @param integer $codetypeactivite
     * @return Enseignements
     */
    public function setCodetypeactivite($codetypeactivite)
    {
        $this->codetypeactivite = $codetypeactivite;

        return $this;
    }

    /**
     * Get codetypeactivite
     *
     * @return integer 
     */
    public function getCodetypeactivite()
    {
        return $this->codetypeactivite;
    }

    /**
     * Set codecomposante
     *
     * @param integer $codecomposante
     * @return Enseignements
     */
    public function setCodecomposante($codecomposante)
    {
        $this->codecomposante = $codecomposante;

        return $this;
    }

    /**
     * Get codecomposante
     *
     * @return integer 
     */
    public function getCodecomposante()
    {
        return $this->codecomposante;
    }

    /**
     * Set codeniveau
     *
     * @param integer $codeniveau
     * @return Enseignements
     */
    public function setCodeniveau($codeniveau)
    {
        $this->codeniveau = $codeniveau;

        return $this;
    }

    /**
     * Get codeniveau
     *
     * @return integer 
     */
    public function getCodeniveau()
    {
        return $this->codeniveau;
    }

    /**
     * Set datedebut
     *
     * @param \DateTime $datedebut
     * @return Enseignements
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    /**
     * Get datedebut
     *
     * @return \DateTime 
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * Set datefin
     *
     * @param \DateTime $datefin
     * @return Enseignements
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin
     *
     * @return \DateTime 
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * Set article6
     *
     * @param boolean $article6
     * @return Enseignements
     */
    public function setArticle6($article6)
    {
        $this->article6 = $article6;

        return $this;
    }

    /**
     * Get article6
     *
     * @return boolean 
     */
    public function getArticle6()
    {
        return $this->article6;
    }
}
