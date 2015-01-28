<?php

namespace LaCagnaProduct\Model;

use Zend\ServiceManager\ServiceLocatorAwareInterface;


class Cocktail
{
    protected $em;
    protected $servicelocator;
    protected $entity;

    public function get($name)
    {
        $this->entity = $this->getEntityManager()->getRepository('LaCagnaProduct\Entity\Cocktail')
        ->findOneByName($name);
        return $this;
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
