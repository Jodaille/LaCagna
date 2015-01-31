<?php

namespace LaCagnaProduct\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TypesFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator) {

        $model = new \LaCagnaProduct\Model\Types();
        $model->setServiceLocator($serviceLocator);
        return $model;
    }
}
