<?php

namespace LaCagnaContent\Navigation;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Navigation\Service\DefaultNavigationFactory;

class LaCagnaNavigation extends DefaultNavigationFactory
{
    protected function getPages(ServiceLocatorInterface $serviceLocator)
    {
        if (null === $this->pages) {
            //FETCH data from table menu :
            $em = $serviceLocator->get('Doctrine\ORM\EntityManager');
            $menuItems = $em->getRepository('LaCagnaContent\Entity\Menu')
                            ->getItems();

            foreach($menuItems as $key=>$item)
            {
                $configuration['navigation'][$this->getName()][$item->getLabel()] = array(
                'label' => $item->getLabel(),
                'route' => $item->getRoute(),
                );
            }

            if (!isset($configuration['navigation'])) {
                throw new \InvalidArgumentException('Could not find navigation configuration key');
            }
            if (!isset($configuration['navigation'][$this->getName()])) {
                throw new \InvalidArgumentException(sprintf(
                'Failed to find a navigation container by the name "%s"',
                $this->getName()
                ));
            }

            $application = $serviceLocator->get('Application');
            $routeMatch  = $application->getMvcEvent()->getRouteMatch();
            $router      = $application->getMvcEvent()->getRouter();
            $pages       = $this->getPagesFromConfig($configuration['navigation'][$this->getName()]);

            $this->pages = $this->injectComponents($pages, $routeMatch, $router);
        }
        return $this->pages;
    }

}
