<?php

namespace LaCagnaContent\Navigation;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Navigation\Service\DefaultNavigationFactory;

class LaCagnaNavigation extends DefaultNavigationFactory
{
    protected $role;
    public function setRole($role)
    {
        $this->role = $role;
    }


    protected function getPages(ServiceLocatorInterface $serviceLocator)
    {
        if (null === $this->pages) {

            $identity = false;
            $t = $serviceLocator->get('translator');

            $zfcuserauth = $serviceLocator->get('zfcuserauthservice');
            if($zfcuserauth->hasIdentity())
            {
                $identity = $zfcuserauth->getIdentity();
            }

            //FETCH data from table menu :
            $em = $serviceLocator->get('Doctrine\ORM\EntityManager');

            if('admin' == $this->role)
            {
                $menuItems = $em->getRepository('LaCagnaContent\Entity\Menu')
                ->getAdminItems();
            }
            else
            {
                $menuItems = $em->getRepository('LaCagnaContent\Entity\Menu')
                ->getItems();
            }


            foreach($menuItems as $key=>$item)
            {
                $label = $item->getLabel();
                $route = $item->getRoute();
                if('zfcuser/login' == $route)
                {
                    if($identity)
                    {
                        $label = $t->translate('Logout');
                        $route = 'zfcuser/logout';
                    }
                    else
                    {
                        $label = $t->translate('Sign In');
                    }
                }

                $configuration['navigation'][$this->getName()][$item->getLabel()] = array(
                'label' => $label,
                'route' => $route,
                );
            }

            if (!isset($configuration['navigation'])) {
                $configuration = array(
                    'navigation' => array(
                        'default' => array(
                            array(
                                'label' => 'Home',
                                'route' => 'home',
                            ),
                        )
                    )
                );
                //throw new \InvalidArgumentException('Could not find navigation configuration key');
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
