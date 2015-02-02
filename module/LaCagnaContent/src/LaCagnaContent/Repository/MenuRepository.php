<?php

namespace LaCagnaContent\Repository;

use Doctrine\ORM\EntityRepository;

class MenuRepository extends EntityRepository
{
    public function getItems()
    {
        $level = 1;

        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('m')
        ->from('LaCagnaContent\Entity\Menu', 'm')
        ->where('m.role <= :level')
        ->orderBy('m.displayorder', 'ASC')
        ->setParameter('level', $level);

        $query = $qb->getQuery();
        $r = $query->getResult();
        return $r;
    }
    public function getAdminItems()
    {
        return $this->findBy(array(), array('displayorder' => 'ASC'));
    }
}
