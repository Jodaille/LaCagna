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

    public function shopName()
    {
        $name = 'Vous Êtes Ici';
        return $name;
    }

    public function shopPictoPath()
    {
        $imgPath = '/img/vous-etes-ici.png';
        return $imgPath;
    }

    public function shopAddress()
    {
        return '13 Rue Saint-Sauveur, 14000 Caen';
    }

    public function shopMapUrl()
    {
        $mapUrl = 'https://www.google.fr/maps/place/';

        $mapUrl .= 'Vous+etes+ici/@49.1836762,-0.3686297,17z/data=!3m1!4b1!4m2!3m1!1s0x480a42bfb6520a53:0x1b94e85157bff1af';
        return $mapUrl;
    }

    public function shopPhone($international = false)
    {
        $phone = '02 50 50 26 02';
        if($international)
        {
            $phone = '+33250502602';
        }
        return $phone;
    }

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
