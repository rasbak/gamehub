<?php
/**
 * Created by PhpStorm.
 * User: moham
 * Date: 18/05/2017
 * Time: 09:54
 */

namespace Esprit\GameHubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * CommentaireForum
 *
 * @ORM\Entity(repositoryClass="Esprit\GameHubBundle\Repository\CommentaireForumRepository")
 */
class CommentaireForum
{/**
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
     *@ORM\ManyToOne (targetEntity="SujetForum")
     */
    private $idSujet;

    /**
     * @return string
     */
    public function getUtilisateurId()
    {
        return $this->utilisateurId;
    }

    /**
     * @param string $utilisateurId
     */
    public function setUtilisateurId($utilisateurId)
    {
        $this->utilisateurId = $utilisateurId;
    }

    /**
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param string $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

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
     * @return mixed
     */
    public function getIdSujet()
    {
        return $this->idSujet;
    }

    /**
     * @param mixed $idSujet
     */
    public function setIdSujet($idSujet)
    {
        $this->idSujet = $idSujet;
    }

}