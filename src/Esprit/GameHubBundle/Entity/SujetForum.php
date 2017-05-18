<?php

namespace Esprit\GameHubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SujetForum
 *
 *
 * @ORM\Entity(repositoryClass="Esprit\GameHubBundle\Repository\SujetForumRepository")
 */
class SujetForum
{

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=500, nullable=false)
     */
    private $contenu;
    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=500, nullable=false)
     */
    private $titre;

    /**
     *@ORM\ManyToOne (targetEntity="Membre")
     */
    private $membreId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="enable", type="integer", nullable=false)
     */
    private $enable;

    /**
     * @return string
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * @param string $enable
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return SujetForum
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
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
     * Set membreId
     *
     * @param integer $membreId
     *
     * @return SujetForum
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return SujetForum
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
