<?php

namespace LaCagnaProduct\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CategoriesFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator) {

        $model = new \LaCagnaProduct\Model\Categories();
        $model->setServiceLocator($serviceLocator);
        return $model;
    }
}
