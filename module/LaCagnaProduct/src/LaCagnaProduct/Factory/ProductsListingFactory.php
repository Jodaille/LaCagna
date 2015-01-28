<?php

namespace LaCagnaProduct\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ProductsListingFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator) {

        $model = new \LaCagnaProduct\Model\ProductsListing();
        $model->setServiceLocator($serviceLocator);
        return $model;
    }
}
