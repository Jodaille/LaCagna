<?php

namespace LaCagnaProduct\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ProductsFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator) {

        $model = new \LaCagnaProduct\Model\Products();
        $model->setServiceLocator($serviceLocator);
        return $model;
    }
}
