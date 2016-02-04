<?php

namespace LaCagnaUser\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BookmarkFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator) {

        $model = new \LaCagnaUser\Model\Bookmark();
        $model->setServiceLocator($serviceLocator);
        return $model;
    }
}
