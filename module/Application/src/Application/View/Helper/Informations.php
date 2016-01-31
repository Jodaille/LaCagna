<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Informations extends AbstractHelper implements ServiceLocatorAwareInterface
{

    protected $serviceLocator;
    protected $em;
    protected $repository;

    public function disclaimer()
    {
        // first one gives access to other view helpers
        $helperPluginManager = $this->getServiceLocator();
        // the second one gives access to... other things.
        $serviceManager = $helperPluginManager->getServiceLocator();

        $t = $serviceManager->get('translator');

        $disclaimer = '&copy; 2015 - ' . date('Y') . ' by LaCagna ';
        $disclaimer .= $t->translate('All rights reserved.');

        return $disclaimer;
    }

    public function homeTitle()
    {
        $title = 'Vous êtes ici !';
        return $title;
    }

    public function legatNotice()
    {
        $legatNotice = "L'abus d'alcool est dangereux pour la santé. ";
        $legatNotice .= "À consommer avec modération.";
        return $legatNotice;
    }

    /**
     * Set the service locator.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return CustomHelper
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }
    /**
     * Get the service locator.
     *
     * @return \Zend\ServiceManager\ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
    public function __invoke()
    {
        $serviceLocator = $this->getServiceLocator();
        return $this;
    }

}
