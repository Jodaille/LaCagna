<?php

namespace LaCagnaProduct\Factory;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Manager implements ServiceLocatorAwareInterface
{
    protected $servicelocator;

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->servicelocator = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->servicelocator;
    }

    public function Categories()
    {
        $model = new \LaCagnaProduct\Model\Categories();
        $model->setServiceLocator($this->servicelocator);
        return $model;
    }
    public function getIngedients()
    {
        $model = new \LaCagnaProduct\Model\Ingredients();
        $model->setServiceLocator($this->servicelocator);
        return $model;
    }
    public function States()
    {
        $model = new \LaCagnaProduct\Model\States();
        $model->setServiceLocator($this->servicelocator);
        return $model;
    }
}
