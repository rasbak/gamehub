<?php

namespace Esprit\GameHubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tournoi
 *
 * @ORM\Table(name="tournoi")
 * @ORM\Entity(repositoryClass="Esprit\GameHubBundle\Repository\TournoiRepository")
 */
class Tournoi
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
     * @ORM\Column(name="nom", type="string", length=30)
     */
    private $nom;


    /**
     * @ORM\Column(type="string")
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;


    /**
     * @var string
     *
     * @ORM\Column(name="jeu", type="string", length=255)
     */
    private $jeu;

    /**
     * @var int
     *
     * @ORM\Column(name="nombeParticipant", type="integer")
     */
    private $nombeParticipant;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255)
     */
    private $lieu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateTournoi", type="date")
     */
    private $dateTournoi;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="HeureTournoi", type="time")
     */
    private $heureTournoi;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Tournoi
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


    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getUploadRootDir()
    {
        // the absolute directory path where uploaded documents should be saved
        return $this->getTmpUploadRootDir() . $this->getId() . "/";
    }

    public function getTmpUploadRootDir()
    {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../web/uploads/images';
    }


    /**
     * Set jeu
     *
     * @param string $jeu
     *
     * @return Tournoi
     */
    public function setJeu($jeu)
    {
        $this->jeu = $jeu;

        return $this;
    }

    /**
     * Get jeu
     *
     * @return string
     */
    public function getJeu()
    {
        return $this->jeu;
    }

    /**
     * Set nombeParticipant
     *
     * @param integer $nombeParticipant
     *
     * @return Tournoi
     */
    public function setNombeParticipant($nombeParticipant)
    {
        $this->nombeParticipant = $nombeParticipant;

        return $this;
    }

    /**
     * Get nombeParticipant
     *
     * @return int
     */
    public function getNombeParticipant()
    {
        return $this->nombeParticipant;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Tournoi
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set dateTournoi
     *
     * @param \DateTime $dateTournoi
     *
     * @return Tournoi
     */
    public function setDateTournoi($dateTournoi)
    {
        $this->dateTournoi = $dateTournoi;

        return $this;
    }

    /**
     * Get dateTournoi
     *
     * @return \DateTime
     */
    public function getDateTournoi()
    {
        return $this->dateTournoi;
    }

    /**
     * Set heureTournoi
     *
     * @param \DateTime $heureTournoi
     *
     * @return Tournoi
     */
    public function setHeureTournoi($heureTournoi)
    {
        $this->heureTournoi = $heureTournoi;

        return $this;
    }

    /**
     * Get heureTournoi
     *
     * @return \DateTime
     */
    public function getHeureTournoi()
    {
        return $this->heureTournoi;
    }
}

