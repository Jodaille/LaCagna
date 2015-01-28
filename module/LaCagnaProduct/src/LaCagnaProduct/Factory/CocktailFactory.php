<?php

namespace LaCagnaProduct\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CocktailFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator) {

        $model = new \LaCagnaProduct\Model\Cocktail();
        $model->setServiceLocator($serviceLocator);
        return $model;
    }
}
