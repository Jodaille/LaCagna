<?php

namespace LaCagnaContent\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class NavigationFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        //die();
        $navigation =  new \LaCagnaContent\Navigation\LaCagnaNavigation();
        return $navigation->createService($serviceLocator);
    }
}
