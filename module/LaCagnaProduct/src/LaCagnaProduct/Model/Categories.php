<?php

namespace LaCagnaProduct\Model;

use Zend\ServiceManager\ServiceLocatorAwareInterface;


class Categories
{
    protected $em;
    protected $servicelocator;

    public function getList()
    {
        $categoryRepository = $this->getEntityManager()
                                ->getRepository('LaCagnaProduct\Entity\Category');
        return $categoryRepository->findAll();
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
