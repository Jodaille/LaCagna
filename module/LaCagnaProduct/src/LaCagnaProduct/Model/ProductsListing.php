<?php

namespace LaCagnaProduct\Model;

use Zend\ServiceManager\ServiceLocatorAwareInterface;


class ProductsListing
{
    protected $em;
    protected $servicelocator;

    public function getList()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->add('select', 'p')
            ->add('from', 'LaCagnaProduct\Entity\Product p')
            ->leftJoin('p.type', 't');
        $qb->leftJoin('p.categories', 'c');

        $qb->orderBy('p.title', 'ASC');

        $query = $qb->getQuery();
        $results = $query->getResult();
        return $results;
    }

    public function getListWithoutCategory()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->add('select', 'p')
            ->add('from', 'LaCagnaProduct\Entity\Product p')
            ->leftJoin('p.type', 't');
        $qb->leftJoin('p.categories', 'c');

        $qb->where('c.id IS NULL');

        $qb->orderBy('p.title', 'ASC');

        $query = $qb->getQuery();
        $results = $query->getResult();
        return $results;
    }

    public function getListOfTreeCategory($category_id)
    {
      $prdRepository = $this->getEntityManager()
                              ->getRepository('LaCagnaProduct\Entity\Product');
      return $prdRepository->getProductsOfChildCategories($category_id);
    }
    public function getTypes()
    {
        $typeRepository = $this->getEntityManager()
                                ->getRepository('LaCagnaProduct\Entity\Type');
        return $typeRepository->findAll();
    }

    public function byType($typename, $state = 'disponible')
    {
        //\Doctrine\Common\Util\Debug::dump($typename);
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->add('select', 'p')
            ->add('from', 'LaCagnaProduct\Entity\Product p')
            ->leftJoin('p.type', 't')
            ->leftJoin('p.state', 'state')
            ->where('t.name = :typename')
            ->andWhere('state.name = :state')
            ->setParameter(':state', $state)
            ->setParameter(':typename', $typename);
        $qb->orderBy('p.title', 'ASC');
        $query = $qb->getQuery();
        $results = $query->getResult();
        return $results;
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
