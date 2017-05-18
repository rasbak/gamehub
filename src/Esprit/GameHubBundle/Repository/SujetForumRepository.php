<?php
/**
 * Created by PhpStorm.
 * User: moham
 * Date: 12/04/2017
 * Time: 09:37
 */

namespace Esprit\GameHubBundle\Repository;

use Doctrine\ORM\EntityRepository ;


class SujetForumRepository  extends EntityRepository
{
public function findbyactive()
{
    $query=$this->getEntityManager()
        ->createQuery("
         select m from EspritGameHubBundle:SujetForum m  where m.enable=1");
    return $query->getResult();
}
}