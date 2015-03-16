<?php

namespace LaCagnaProduct\Model;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Doctrine\ORM\Query\ResultSetMapping;

class Categories
{
    protected $em;
    protected $servicelocator;

    public function getList()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->add('select', 'c')
            ->add('from', 'LaCagnaProduct\Entity\Category c');
        $qb->orderBy('c.title', 'ASC');
        $qb->addOrderBy('c.rgt', 'ASC');

        $query = $qb->getQuery();
        $results = $query->getResult();
        return $results;
    }

    public function getProductList($product)
    {
        $categories = array();
        if($product)
        {
            foreach($product->getCategories() as $category)
            {
                $categories[$category->getId()] = array(
                    'id'        => $category->getId(),
                    'title'     => $category->getTitle(),
                    'selected'  => true,
                );
            }
        }

        foreach($this->getList() as $category)
        {
            if(!isset($categories[$category->getId()]))
            {
                $categories[$category->getId()] = array(
                    'id' => $category->getId(),
                    'title' => $category->getTitle(),
                );
            }
        }
        return $categories;
    }

    public function get($id)
    {
        return $categoryRepository = $this->getEntityManager()
        ->getRepository('LaCagnaProduct\Entity\Category')
        ->find($id);
    }

    public function getChildCategories($category_id)
    {
      $category = $this->get($category_id);
      $left =     $category->GetLeftValue();
      $right =     $category->GetRightValue();
      $qb = $this->getEntityManager()->createQueryBuilder();
      $qb->select('c')
      ->from('LaCagnaProduct\Entity\Category', 'c')
      ->where('c.lft >= :left')
      ->andWhere('c.rgt <= :right')
      ->setParameters(
          array(':left' => $left,
                ':right' => $right)
          );
      $query = $qb->getQuery();
      return $query->getResult();
    }

    public function productsCategory($category_id,$limit=50)
    {
      $categories = $this->getChildCategories($category_id);
      $cIds = array();
      foreach($categories as $c)
      {
        $cIds[] = $c->getId();
      }
      $qb = $this->getEntityManager()->createQueryBuilder();
      $qb->select('p')
         ->from('LaCagnaProduct\Entity\Product', 'p')
         ->innerJoin('p.categories', 'c')
         ->where($qb->expr()->in('c', '?1'))
         ->orderBy('p.id', 'DESC')
         ->setParameter('1',$categories);
      if($limit)
         $qb->setMaxResults($limit);

      $query = $qb->getQuery();

      return $query->getResult();
    }

    public function listCategoriesAsTree()
    {
      $query = "SELECT node.id as category_id,
                  CONCAT( REPEAT('  -=|=-  ', COUNT(parent.title) - 1))
                    AS treeview,
                  count(parent.title) - 1 as indentation,
                  node.title
                FROM
                  categories AS node, categories AS parent
                WHERE
                  node.lft
                BETWEEN parent.lft AND parent.rgt
                GROUP BY
                  node.title
                ORDER BY
                  node.lft";

      $rsm = new ResultSetMapping();
      $rsm->addScalarResult('title', 'title');
      $rsm->addScalarResult('category_id', 'category_id');
      $rsm->addScalarResult('treeview', 'treeview');
      $rsm->addScalarResult('indentation', 'indentation');


      $query = $this->getEntityManager()->createNativeQuery($query, $rsm);
      return $query->getResult();
    }

    public function edit($id = false, $values)
    {
        $category = false;
        $categoryRepository = $this->getEntityManager()
                            ->getRepository('LaCagnaProduct\Entity\Category');

        if($id)
        {
            $category = $categoryRepository->find($id);
        }
        if(!$category)
            $category = new \LaCagnaProduct\Entity\Category();

        $code           = @$values['code'];
        $title          = $values['title'];
        $displayorder   = @$values['displayorder'];
        if(empty($displayorder))
            $displayorder = 0;

        if(empty($code))
        {
          $code = \LaCagnaProduct\Model\Products::cleanString($title);
        }
          //$code = preg_replace("/[^A-Za-z0-9]/", "", $title);

        $category->setCode($code);
        $category->setTitle($title);
        $category->setDisplayorder($displayorder);

        $this->getEntityManager()->persist($category);
        $this->getEntityManager()->flush();

        return $category;
    }

    public function chooseParent($category_id, $parent_id)
    {
      $categoryRepository = $this->getEntityManager()
                            ->getRepository('LaCagnaProduct\Entity\Category');
      $nsm      = $this->getNestedSetManager();
      $category = $categoryRepository->find($category_id);
      $parent   = $categoryRepository->find($parent_id);

      $nodeParent = $nsm->wrapNode($parent);
      $node       = $nsm->wrapNode($category);
      $node->insertAsLastChildOf($nodeParent);
    }

    public function createRoot($categorytitle = "Accueil") {

        $nsm = $this->getNestedSetManager();

        $categoryRepository = $this->getEntityManager()
        ->getRepository('LaCagnaProduct\Entity\Category');

        $category = $categoryRepository->findOneByTitle($categorytitle);

        if(!$category)
            $category = new \LaCagnaProduct\Entity\Category();

        $category->setCode('Root Category');
        $category->setTitle($categorytitle);

        $rootNode = $nsm->createRoot($category);

        $this->getEntityManager()->persist($category);

        $this->getEntityManager()->flush();
        return $category;
    }
    /**
    *
    * @param type $categoryId
    * @param \LaCagna\Entity\Category $category
    */
    public function addChild(\LaCagna\Entity\Category $category, \LaCagna\Entity\Category $parentCategory)
    {
        $nsm = $this->getNestedSetManager();
        $node = $nsm->wrapNode($parentCategory);
        $node->addChild($category);
    }

    /**
    *
    * @param type $categoryId
    * @param \LaCagna\Entity\Category $category
    */
    public function moveAsLastChild(\LaCagna\Entity\Category $category, \LaCagna\Entity\Category $parentCategory)
    {
        $nsm = $this->getNestedSetManager();
        $nodeParentCategory = $nsm->wrapNode($parentCategory);
        $node = $nsm->wrapNode($category);
        $node->moveAsLastChildOf($nodeParentCategory);
    }

    /**
    *
    * @param type $categoryId
    * @param \LaCagna\Entity\Category $category
    */
    public function insertAsLastChild(\LaCagna\Entity\Category $category, \LaCagna\Entity\Category $parentCategory)
    {
        $nsm = $this->getNestedSetManager();
        $nodeParentCategory = $nsm->wrapNode($parentCategory);
        $node = $nsm->wrapNode($category);
        $node->insertAsLastChildOf($nodeParentCategory);
    }
    public function getNestedSetManager()
    {
        $config = new \DoctrineExtensions\NestedSet\Config($this->getEntityManager(), 'LaCagnaProduct\Entity\Category');
        $nsm = new \DoctrineExtensions\NestedSet\Manager($config);
        return $nsm;
    }

    public function getEntityManager()
    {
        if (null === $this->em)
        {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    public function setServiceLocator($serviceLocator)
    {
        $this->servicelocator = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->servicelocator;
    }
}
