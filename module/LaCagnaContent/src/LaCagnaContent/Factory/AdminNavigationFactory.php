<?php

namespace LaCagnaContent\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AdminNavigationFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        //die(__FILE__);
        $navigation =  new \LaCagnaContent\Navigation\LaCagnaNavigation();
        $navigation->setRole('admin');
        return $navigation->createService($serviceLocator);
    }
}
