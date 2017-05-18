<?php

namespace Esprit\GameHubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notification
 *
 * @ORM\Table(name="notification", indexes={@ORM\Index(name="fk_Njeu", columns={"id_jeu"}), @ORM\Index(name="fk_Naccessoire", columns={"id_accessoire"}), @ORM\Index(name="fk_Njeuamateur", columns={"id_jeuamateur"})})
 * @ORM\Entity
 */
class Notification
{
    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=255, nullable=false)
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enable", type="boolean", nullable=false)
     */
    private $enable;

    /**
     * @var integer
     *
     * @ORM\Column(name="membre_id", type="integer", nullable=false)
     */
    private $membreId;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_jeuamateur", type="integer", nullable=true)
     */

    private $idJeuamateur;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_jeu", type="integer", nullable=true)
     */
    private $idJeu;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_accessoire", type="integer", nullable=true)
     */
    private $idAccessoire;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Notification
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Notification
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set enable
     *
     * @param boolean $enable
     *
     * @return Notification
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;

        return $this;
    }

    /**
     * Get enable
     *
     * @return boolean
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * Set membreId
     *
     * @param integer $membreId
     *
     * @return Notification
     */
    public function setMembreId($membreId)
    {
        $this->membreId = $membreId;

        return $this;
    }

    /**
     * Get membreId
     *
     * @return integer
     */
    public function getMembreId()
    {
        return $this->membreId;
    }

    /**
     * Set idJeuamateur
     *
     * @param integer $idJeuamateur
     *
     * @return Notification
     */
    public function setIdJeuamateur($idJeuamateur)
    {
        $this->idJeuamateur = $idJeuamateur;

        return $this;
    }

    /**
     * Get idJeuamateur
     *
     * @return integer
     */
    public function getIdJeuamateur()
    {
        return $this->idJeuamateur;
    }

    /**
     * Set idJeu
     *
     * @param integer $idJeu
     *
     * @return Notification
     */
    public function setIdJeu($idJeu)
    {
        $this->idJeu = $idJeu;

        return $this;
    }

    /**
     * Get idJeu
     *
     * @return integer
     */
    public function getIdJeu()
    {
        return $this->idJeu;
    }

    /**
     * Set idAccessoire
     *
     * @param integer $idAccessoire
     *
     * @return Notification
     */
    public function setIdAccessoire($idAccessoire)
    {
        $this->idAccessoire = $idAccessoire;

        return $this;
    }

    /**
     * Get idAccessoire
     *
     * @return integer
     */
    public function getIdAccessoire()
    {
        return $this->idAccessoire;
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
