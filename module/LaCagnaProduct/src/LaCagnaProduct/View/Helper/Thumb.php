<?php
namespace LaCagnaProduct\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceManager;

class Thumb extends AbstractHelper
{

    protected $serviceLocator;
    protected $em;
    protected $repository;

    public function getSlug($slug, $format)
    {
      $slug = str_replace('/img/',"/img/$format/", $slug);
      return $slug;
    }

    public function setServiceLocator(ServiceManager $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getEntityManager()
    {
        if (null === $this->em)
        {
            $this->em = $this->serviceLocator->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    public function __invoke()
    {
        return $this;
    }

}
