<?php

namespace LaCagnaProduct\Model;

use Zend\ServiceManager\ServiceLocatorAwareInterface;


class Prices
{
    protected $em;
    protected $servicelocator;

    public function getProductPrice($product,
                                    $charac = 'Volume',
                                    $limit = false)
    {
        $productid = $product->getId();

        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->add('select', 'prices, a')
            ->add('from', 'LaCagnaProduct\Entity\Price prices')

            ->leftJoin('prices.article', 'a')

            ->leftJoin('a.products', 'p');
        $qb->leftJoin('a.characteristicsvalues', 'values');
        $qb->leftJoin('values.characteristic', 'characteristic');

        $qb->andWhere('p.id = :productid');

        $qb->andWhere('characteristic.abbreviation = :charac')
            ->setParameter(':charac', $charac)
            ->setParameter(':productid', $productid);

        $qb->orderBy('prices.value', 'ASC');

        if($limit == 1)
        {
            $qb->setMaxResults($limit);
            $query = $qb->getQuery();
            $results = $query->getOneOrNullResult();
        }
        else
        {
            if($limit)
                $qb->setMaxResults($limit);
            $query = $qb->getQuery();
            $results = $query->getResult();
        }
        //echo '<pre>';\Doctrine\Common\Util\Debug::dump($results);die();

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
