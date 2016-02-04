<?php
namespace LaCagnaUser\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Bookmark extends AbstractHelper implements ServiceLocatorAwareInterface
{

    protected $serviceLocator;
    protected $em;
    protected $repository;

    public function isProductBookmarked($product)
    {
        $isBookmarked = false;
        // first one gives access to other view helpers
        $helperPluginManager = $this->getServiceLocator();
        // the second one gives access to... other things.
        $serviceManager = $helperPluginManager->getServiceLocator();

        $bookmark = $serviceManager->get('bookmark');

        $auth = $serviceManager->get('zfcuser_auth_service');

        if ($auth->hasIdentity() && $product) {
            $isBookmarked = $bookmark->isProductBookmarked(
                $auth->getIdentity(), $product
                );
        }

        return $isBookmarked;
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
