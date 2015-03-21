<?php

namespace LaCagnaProduct\Repository;

use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
  public function getProductsOfChildCategories($category_id)
  {

    $category = $this->getEntityManager()
                    ->getRepository('LaCagnaProduct\Entity\Category')
                    ->find($category_id);
    $left =     $category->GetLeftValue();
    $right =     $category->GetRightValue();
    $qb = $this->getEntityManager()->createQueryBuilder();
    $qb->select('p,c')
    ->from('LaCagnaProduct\Entity\Product', 'p')
    ->leftJoin('p.categories', 'c')
    ->where('c.lft >= :left')
    ->andWhere('c.rgt <= :right')
    ->setParameters(
        array(':left' => $left,
              ':right' => $right)
        );
    $qb->orderBy('p.title', 'ASC');
    $query = $qb->getQuery();
    return $query->getResult();
  }
}
