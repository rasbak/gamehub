<?php

namespace Esprit\GameHubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * participant
 *
 * @ORM\Table(name="participant")
 * @ORM\Entity(repositoryClass="Esprit\GameHubBundle\Repository\ParticipantRepository")
 */
class Participant
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_membre", type="string", length=255)
     */
    private $nomMembre;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_tournoi", type="string", length=255)
     */
    private $nomTournoi;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomMembre
     *
     * @param string $nomMembre
     *
     * @return participant
     */
    public function setNomMembre($nomMembre)
    {
        $this->nomMembre = $nomMembre;

        return $this;
    }

    /**
     * Get nomMembre
     *
     * @return string
     */
    public function getNomMembre()
    {
        return $this->nomMembre;
    }

    /**
     * Set nomTournoi
     *
     * @param string $nomTournoi
     *
     * @return participant
     */
    public function setNomTournoi($nomTournoi)
    {
        $this->nomTournoi = $nomTournoi;

        return $this;
    }

    /**
     * Get nomTournoi
     *
     * @return string
     */
    public function getNomTournoi()
    {
        return $this->nomTournoi;
    }
}

