<?php

namespace Esprit\GameHubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CaracteristiqueJeu
 *
 * @ORM\Table(name="caracteristique_jeu")
 * @ORM\Entity
 */
class CaracteristiqueJeu
{
    /**
     * @var string
     *
     * @ORM\Column(name="processeur", type="string", length=20, nullable=false)
     */
    private $processeur;

    /**
     * @var string
     *
     * @ORM\Column(name="memoire", type="string", length=20, nullable=false)
     */
    private $memoire;

    /**
     * @var string
     *
     * @ORM\Column(name="carte_graphique", type="string", length=20, nullable=false)
     */
    private $carteGraphique;

    /**
     * @var string
     *
     * @ORM\Column(name="systeme_exploitation", type="string", length=20, nullable=false)
     */
    private $systemeExploitation;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set processeur
     *
     * @param string $processeur
     *
     * @return CaracteristiqueJeu
     */
    public function setProcesseur($processeur)
    {
        $this->processeur = $processeur;

        return $this;
    }

    /**
     * Get processeur
     *
     * @return string
     */
    public function getProcesseur()
    {
        return $this->processeur;
    }

    /**
     * Set memoire
     *
     * @param string $memoire
     *
     * @return CaracteristiqueJeu
     */
    public function setMemoire($memoire)
    {
        $this->memoire = $memoire;

        return $this;
    }

    /**
     * Get memoire
     *
     * @return string
     */
    public function getMemoire()
    {
        return $this->memoire;
    }

    /**
     * Set carteGraphique
     *
     * @param string $carteGraphique
     *
     * @return CaracteristiqueJeu
     */
    public function setCarteGraphique($carteGraphique)
    {
        $this->carteGraphique = $carteGraphique;

        return $this;
    }

    /**
     * Get carteGraphique
     *
     * @return string
     */
    public function getCarteGraphique()
    {
        return $this->carteGraphique;
    }

    /**
     * Set systemeExploitation
     *
     * @param string $systemeExploitation
     *
     * @return CaracteristiqueJeu
     */
    public function setSystemeExploitation($systemeExploitation)
    {
        $this->systemeExploitation = $systemeExploitation;

        return $this;
    }

    /**
     * Get systemeExploitation
     *
     * @return string
     */
    public function getSystemeExploitation()
    {
        return $this->systemeExploitation;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
