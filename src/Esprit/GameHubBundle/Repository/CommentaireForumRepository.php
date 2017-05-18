<?php
namespace Esprit\GameHubBundle\Repository;
use Doctrine\ORM\EntityRepository ;

class CommentaireForumRepository extends EntityRepository
{
    public function findbysujet($id)
    {
        $query=$this->getEntityManager()
            ->createQuery("
         select m.contenu from EspritGameHubBundle:CommentaireForum m  where m.idSujet='$id'");
        return $query->getResult();

    }
}