<?php

namespace LaCagnaUser\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserAdminFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator) {

        $model = new \LaCagnaUser\Model\UserAdmin();
        $model->setServiceLocator($serviceLocator);
        return $model;
    }
}
