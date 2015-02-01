<?php

namespace LaCagnaContent\Repository;

use Doctrine\ORM\EntityRepository;

class MenuRepository extends EntityRepository
{
    public function getItems()
    {
        /*$menuRepository = $this->getEntityManager()
                            ->getRepository('LaCagnaContent\Entity\Menu');
        return $menuRepository->findAll();*/
        return $this->findBy(array(), array('displayorder' => 'ASC'));
    }
}
