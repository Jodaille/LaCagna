<?php

namespace LaCagnaProduct\Model;

use Zend\ServiceManager\ServiceLocatorAwareInterface;


class Ingredients
{
    protected $em;
    protected $servicelocator;

    public function getList()
    {
        $repository = $this->getEntityManager()
                                ->getRepository('LaCagnaProduct\Entity\Ingredient');
        return $repository->findAll();
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
