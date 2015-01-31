<?php

namespace LaCagnaProduct\Model;

use Zend\ServiceManager\ServiceLocatorAwareInterface;


class Types
{
    protected $em;
    protected $servicelocator;
    protected $entity;

    public function get($name)
    {
        $this->entity = $this->getEntityManager()
                        ->getRepository('LaCagnaProduct\Entity\Type')
                        ->findOneByName($name);
        return $this;
    }

    public function getList()
    {
        $ProductRepository = $this->getEntityManager()
        ->getRepository('LaCagnaProduct\Entity\Type');
        return $ProductRepository->findAll();
    }

    public function listType($typename)
    {
        //\Doctrine\Common\Util\Debug::dump($typename);

        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->add('select', 'c')
        ->add('from', 'LaCagnaProduct\Entity\Product c')
        ->leftJoin('c.type', 't')
        ->where('t.name = :typename')
        ->setParameter(':typename', $typename);
        //$qb = $this->buildOrder($qb, $order);
        //$qb->setFirstResult($offset)
        //->setMaxResults($limit);
        $query = $qb->getQuery();
        $results = $query->getResult();
        return $results;
    }

    public function getName()
    {
        if($this->entity)
        {
            return $this->entity->getName();
        }
        return false;
    }
    public function getDescription()
    {
        if($this->entity)
        {
            return $this->entity->getDescription();
        }
        return false;
    }
    public function getType()
    {
        if($this->entity)
        {
            return $this->entity->getType();
        }
        return false;
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
