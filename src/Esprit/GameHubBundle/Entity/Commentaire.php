<?php

namespace Esprit\GameHubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire", indexes={@ORM\Index(name="fk_Cjeu", columns={"id_jeu"}), @ORM\Index(name="fk_Cja", columns={"id_jeuamateur"}), @ORM\Index(name="fk_Caccessoire", columns={"id_accessoire"})})
 * @ORM\Entity(repositoryClass="Esprit\GameHubBundle\Repository\CommentaireRepository")
 */
class Commentaire
{
    /**
     * @var string
     *
     * @ORM\Column(name="utilisateur_id", type="string", length=30, nullable=false)
     */
    private $utilisateurId;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=200, nullable=false)
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

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
     * @ORM\Column(name="id_jeuamateur", type="integer", nullable=true)
     */
    private $idJeuamateur;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set utilisateurId
     *
     * @param string $utilisateurId
     *
     * @return Commentaire
     */
    public function setUtilisateurId($utilisateurId)
    {
        $this->utilisateurId = $utilisateurId;

        return $this;
    }

    /**
     * Get utilisateurId
     *
     * @return string
     */
    public function getUtilisateurId()
    {
        return $this->utilisateurId;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Commentaire
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
     * @return Commentaire
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
     * Set idJeu
     *
     * @param integer $idJeu
     *
     * @return Commentaire
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
     * @return Commentaire
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
     * Set idJeuamateur
     *
     * @param integer $idJeuamateur
     *
     * @return Commentaire
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }




}
