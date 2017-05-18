<?php

namespace Esprit\GameHubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Accessoire
 *
 * @ORM\Table(name="accessoire")
 * @ORM\Entity
 */
class Accessoire
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_produit", type="string", length=150, nullable=false)
     */
    private $nomProduit;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix_produit", type="integer", nullable=false)
     */
    private $prixProduit;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_sortie", type="date", nullable=false)
     */
    private $dateSortie;

    /**
     * @var integer
     *
     * @ORM\Column(name="evaluation", type="integer", nullable=true)
     */
    private $evaluation;

    /**
     * @var string
     *
     * @ORM\Column(name="type_produit", type="string", length=150, nullable=false)
     */
    private $typeProduit;

    /**
     * @var boolean
     *
     * @ORM\Column(name="caracteristique", type="boolean", nullable=true)
     */
    private $caracteristique;

    /**
     * @var string
     *
     * @ORM\Column(name="processeur_p", type="string", length=150, nullable=true)
     */
    private $processeurP;

    /**
     * @var string
     *
     * @ORM\Column(name="disque_dur_p", type="string", length=150, nullable=true)
     */
    private $disqueDurP;

    /**
     * @var string
     *
     * @ORM\Column(name="memoire_p", type="string", length=150, nullable=true)
     */
    private $memoireP;

    /**
     * @var string
     *
     * @ORM\Column(name="carte_graphique_p", type="string", length=150, nullable=true)
     */
    private $carteGraphiqueP;

    /**
     * @var string
     *
     * @ORM\Column(name="longueur", type="string", length=150, nullable=true)
     */
    private $longueur;

    /**
     * @var string
     *
     * @ORM\Column(name="poids", type="string", length=150, nullable=true)
     */
    private $poids;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_souris", type="string", length=150, nullable=true)
     */
    private $nomSouris;

    /**
     * @var string
     *
     * @ORM\Column(name="type_casque", type="string", length=150, nullable=true)
     */
    private $typeCasque;

    /**
     * @var string
     *
     * @ORM\Column(name="system_acoustique", type="string", length=150, nullable=true)
     */
    private $systemAcoustique;

    /**
     * @var string
     *
     * @ORM\Column(name="longueur_cable", type="string", length=150, nullable=true)
     */
    private $longueurCable;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_casque", type="string", length=150, nullable=true)
     */
    private $nomCasque;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_clavier", type="string", length=150, nullable=true)
     */
    private $nomClavier;

    /**
     * Accessoire constructor.
     * @param int $id
     * @param string $nomProduit
     * @param int $prixProduit
     * @param \DateTime $dateSortie
     * @param int $evaluation
     * @param string $typeProduit
     * @param bool $caracteristique
     * @param string $processeurP
     * @param string $disqueDurP
     * @param string $memoireP
     * @param string $carteGraphiqueP
     * @param string $longueur
     * @param string $poids
     * @param string $nomSouris
     * @param string $typeCasque
     * @param string $systemAcoustique
     * @param string $longueurCable
     * @param string $nomCasque
     * @param string $nomClavier
     */


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNomProduit()
    {
        return $this->nomProduit;
    }

    /**
     * @param string $nomProduit
     */
    public function setNomProduit($nomProduit)
    {
        $this->nomProduit = $nomProduit;
    }

    /**
     * @return int
     */
    public function getPrixProduit()
    {
        return $this->prixProduit;
    }

    /**
     * @param int $prixProduit
     */
    public function setPrixProduit($prixProduit)
    {
        $this->prixProduit = $prixProduit;
    }

    /**
     * @return \DateTime
     */
    public function getDateSortie()
    {
        return $this->dateSortie;
    }

    /**
     * @param \DateTime $dateSortie
     */
    public function setDateSortie($dateSortie)
    {
        $this->dateSortie = $dateSortie;
    }

    /**
     * @return int
     */
    public function getEvaluation()
    {
        return $this->evaluation;
    }

    /**
     * @param int $evaluation
     */
    public function setEvaluation($evaluation)
    {
        $this->evaluation = $evaluation;
    }

    /**
     * @return string
     */
    public function getTypeProduit()
    {
        return $this->typeProduit;
    }

    /**
     * @param string $typeProduit
     */
    public function setTypeProduit($typeProduit)
    {
        $this->typeProduit = $typeProduit;
    }

    /**
     * @return bool
     */
    public function isCaracteristique()
    {
        return $this->caracteristique;
    }

    /**
     * @param bool $caracteristique
     */
    public function setCaracteristique($caracteristique)
    {
        $this->caracteristique = $caracteristique;
    }

    /**
     * @return string
     */
    public function getProcesseurP()
    {
        return $this->processeurP;
    }

    /**
     * @param string $processeurP
     */
    public function setProcesseurP($processeurP)
    {
        $this->processeurP = $processeurP;
    }

    /**
     * @return string
     */
    public function getDisqueDurP()
    {
        return $this->disqueDurP;
    }

    /**
     * @param string $disqueDurP
     */
    public function setDisqueDurP($disqueDurP)
    {
        $this->disqueDurP = $disqueDurP;
    }

    /**
     * @return string
     */
    public function getMemoireP()
    {
        return $this->memoireP;
    }

    /**
     * @param string $memoireP
     */
    public function setMemoireP($memoireP)
    {
        $this->memoireP = $memoireP;
    }

    /**
     * @return string
     */
    public function getCarteGraphiqueP()
    {
        return $this->carteGraphiqueP;
    }

    /**
     * @param string $carteGraphiqueP
     */
    public function setCarteGraphiqueP($carteGraphiqueP)
    {
        $this->carteGraphiqueP = $carteGraphiqueP;
    }

    /**
     * @return string
     */
    public function getLongueur()
    {
        return $this->longueur;
    }

    /**
     * @param string $longueur
     */
    public function setLongueur($longueur)
    {
        if ($longueur != null)
        {
            $this->longueur = $longueur;
        }
    }

    /**
     * @return string
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * @param string $poids
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;
    }

    /**
     * @return string
     */
    public function getNomSouris()
    {
        return $this->nomSouris;
    }

    /**
     * @param string $nomSouris
     */
    public function setNomSouris($nomSouris)
    {
        $this->nomSouris = $nomSouris;
    }

    /**
     * @return string
     */
    public function getTypeCasque()
    {
        return $this->typeCasque;
    }

    /**
     * @param string $typeCasque
     */
    public function setTypeCasque($typeCasque)
    {
        $this->typeCasque = $typeCasque;
    }

    /**
     * @return string
     */
    public function getSystemAcoustique()
    {
        return $this->systemAcoustique;
    }

    /**
     * @param string $systemAcoustique
     */
    public function setSystemAcoustique($systemAcoustique)
    {
        $this->systemAcoustique = $systemAcoustique;
    }

    /**
     * @return string
     */
    public function getLongueurCable()
    {
        return $this->longueurCable;
    }

    /**
     * @param string $longueurCable
     */
    public function setLongueurCable($longueurCable)
    {
        $this->longueurCable = $longueurCable;
    }

    /**
     * @return string
     */
    public function getNomCasque()
    {
        return $this->nomCasque;
    }

    /**
     * @param string $nomCasque
     */
    public function setNomCasque($nomCasque)
    {
        $this->nomCasque = $nomCasque;
    }

    /**
     * @return string
     */
    public function getNomClavier()
    {
        return $this->nomClavier;
    }

    /**
     * @param string $nomClavier
     */
    public function setNomClavier($nomClavier)
    {
        $this->nomClavier = $nomClavier;
    }


}

