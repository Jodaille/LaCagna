<?php

namespace LaCagnaAdviseMe\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AdviseMeFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator) {

        $model = new \LaCagnaAdviseMe\Model\AdviseMe();
        $model->setServiceLocator($serviceLocator);
        return $model;
    }
}
