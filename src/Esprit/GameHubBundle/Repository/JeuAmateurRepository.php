<?php
namespace Esprit\GameHubBundle\Repository;
use Doctrine\ORM\EntityRepository;

/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 15/03/2017
 * Time: 22:51
 */
class JeuAmateurRepository extends EntityRepository
{
    public function findPayQB($pays){
        $query=$this->createQueryBuilder('s');
        $query->where("s.pays=:pays")->setParameter('pays',$pays);
        return $query->getQuery()->getResult();
    }

    public function findByN($nom){

        $query=$this->getEntityManager()
            ->createQuery("select j.id,j.nom,j.membre,j.evaluation,j.categorie from EspritGameHubBundle:JeuAmateur j 
                             where j.nom=:nom")->setParameter('nom',$nom);
        return $query->getResult();
    }
}