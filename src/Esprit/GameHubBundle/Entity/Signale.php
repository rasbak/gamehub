<?php
/**
 * Created by PhpStorm.
 * User: moham
 * Date: 11/04/2017
 * Time: 18:30
 */


namespace Esprit\GameHubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Signal
 *
 *
 * @ORM\Entity
 */
class Signale
{/**
 * @var integer
 *
 * @ORM\Column(name="`id`", type="integer")
 * @ORM\Id
 * @ORM\GeneratedValue(strategy="IDENTITY")
 */
    private $id;
    /**
     *@ORM\ManyToOne (targetEntity="Membre")
     */
    private $idmembre;
    /**
     * @var integer
     *@ORM\ManyToOne (targetEntity="SujetForum")
     */
    private $idsujet;
    /**
     * @var string
     *
     * @ORM\Column(name="`cause`", type="string", length=500, nullable=false)
     */
    private $cause;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdmembre()
    {
        return $this->idmembre;
    }

    /**
     * @param mixed $idmembre
     */
    public function setIdmembre($idmembre)
    {
        $this->idmembre = $idmembre;
    }

    /**
     * @return mixed
     */
    public function getIdsujet()
    {
        return $this->idsujet;
    }

    /**
     * @param mixed $idsujet
     */
    public function setIdsujet($idsujet)
    {
        $this->idsujet = $idsujet;
    }

    /**
     * @return mixed
     */
    public function getCause()
    {
        return $this->cause;
    }

    /**
     * @param mixed $cause
     */
    public function setCause($cause)
    {
        $this->cause = $cause;
    }


}