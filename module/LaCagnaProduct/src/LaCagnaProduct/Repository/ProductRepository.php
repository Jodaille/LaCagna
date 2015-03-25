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
    $results = $query->getResult();
    //echo '<pre>';\Doctrine\Common\Util\Debug::dump($results);die();
    return $results;

  }
  public function byCategoryCode($code, $state = 'disponible')
  {

    $category = $this->getEntityManager()
                    ->getRepository('LaCagnaProduct\Entity\Category')
                    ->findOneByCode($code);
    $left           = $category->GetLeftValue();
    $right          = $category->GetRightValue();

    $qb = $this->getEntityManager()->createQueryBuilder();
    $qb->select('p,c')
        ->from('LaCagnaProduct\Entity\Product', 'p')
        ->leftJoin('p.categories', 'c')
        ->leftJoin('p.state', 's')

        ->where('c.lft >= :left')
        ->andWhere('c.rgt <= :right')
        ->andWhere('s.name = :state')
        ->setParameters(
            array(':left' => $left,
                  ':right' => $right,
                  ':state' => $state,
                  )
            );

    $qb->orderBy('p.title', 'ASC');

    $query = $qb->getQuery();

    $results = $query->getResult();

    return $results;
  }

  public function byCategorySlug($slug, $state = 'disponible')
  {

    $category = $this->getEntityManager()
                    ->getRepository('LaCagnaProduct\Entity\Category')
                    ->findOneBySlug($slug);
    $left =     $category->GetLeftValue();
    $right =     $category->GetRightValue();

    $qb = $this->getEntityManager()->createQueryBuilder();
    $qb->select('p,c')
        ->from('LaCagnaProduct\Entity\Product', 'p')
        ->leftJoin('p.categories', 'c')
        ->leftJoin('p.state', 's')

        ->where('c.lft >= :left')
        ->andWhere('c.rgt <= :right')
        ->andWhere('s.name = :state')

        ->setParameters(
            array(':left' => $left,
                  ':right' => $right,
                  ':state' => $state,
                  )
            );
    $qb->orderBy('p.title', 'ASC');
    $query = $qb->getQuery();
    return $query->getResult();
  }
}
