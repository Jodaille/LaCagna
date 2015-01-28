<?php

namespace Product\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CocktailTypeFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator) {

        $model = new \Product\Model\CocktailType();
        $model->setServiceLocator($serviceLocator);
        return $model;
    }
}
