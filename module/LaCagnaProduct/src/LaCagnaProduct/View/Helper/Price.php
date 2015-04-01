<?php
namespace LaCagnaProduct\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Price extends AbstractHelper implements ServiceLocatorAwareInterface
{

    protected $serviceLocator;
    protected $em;
    protected $repository;

    public function getProductPrice($product,
                                    $charac = 'Volume',
                                    $limit = false)
    {
        // first one gives access to other view helpers
        $helperPluginManager = $this->getServiceLocator();
        // the second one gives access to... other things.
        $serviceManager = $helperPluginManager->getServiceLocator();

        $prices = $serviceManager->get('Prices');
        $price = $prices->getProductPrice($product,
                                        $charac,
                                        $limit);

        return $price;
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
