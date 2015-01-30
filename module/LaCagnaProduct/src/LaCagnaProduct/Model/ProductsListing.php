<?php

namespace LaCagnaProduct\Model;

use Zend\ServiceManager\ServiceLocatorAwareInterface;


class ProductsListing
{
    protected $em;
    protected $servicelocator;

    public function getTypes()
    {
        $typeRepository = $this->getEntityManager()
                                ->getRepository('LaCagnaProduct\Entity\Type');
        return $typeRepository->findAll();
    }

    public function byType($typename)
    {
        //\Doctrine\Common\Util\Debug::dump($typename);

        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->add('select', 'p')
        ->add('from', 'LaCagnaProduct\Entity\Product p')
        ->leftJoin('p.type', 't')
        ->where('t.name = :typename')
        ->setParameter(':typename', $typename);
        //$qb = $this->buildOrder($qb, $order);
        //$qb->setFirstResult($offset)
        //->setMaxResults($limit);
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
