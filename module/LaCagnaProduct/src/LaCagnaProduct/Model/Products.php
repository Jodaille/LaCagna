<?php

namespace LaCagnaProduct\Model;

use Zend\ServiceManager\ServiceLocatorAwareInterface;


class Products
{
    protected $em;
    protected $servicelocator;

    public function getList()
    {
        $ProductRepository = $this->getEntityManager()
                                ->getRepository('LaCagnaProduct\Entity\Product');
        return $ProductRepository->findAll();
    }

    public function get($id)
    {
        return $ProductRepository = $this->getEntityManager()
        ->getRepository('LaCagnaProduct\Entity\Product')
        ->find($id);
    }

    public function edit($id = false, $values)
    {
        $Product = false;
        $ProductRepository = $this->getEntityManager()
                            ->getRepository('LaCagnaProduct\Entity\Product');

        if($id)
        {
            $Product = $ProductRepository->find($id);
        }
        if(!$Product)
            $Product = new \LaCagnaProduct\Entity\Product();

        $code           = $values['code'];
        $title          = $values['title'];
        $typeid         = $values['type'];
        $stateid        = $values['state'];
        $description    = $values['description'];

        if(empty($code))
            $code = preg_replace("/[^A-Za-z0-9]/", "", $title);

        $Product->setCode($code);
        $Product->setTitle($title);

        $Product->setDescription($description);

        if($stateid)
        {
            $state = $this->getEntityManager()
            ->getRepository('LaCagnaProduct\Entity\State')
            ->find($stateid);
            if($state)
                $Product->setState($state);
        }


        $type = $this->getEntityManager()
                ->getRepository('LaCagnaProduct\Entity\Type')
                ->find($typeid);

        $Product->setType($type);

        $this->getEntityManager()->persist($Product);
        $this->getEntityManager()->flush();

        return $Product;
    }

    public function getEntityManager()
    {
        if (null === $this->em)
        {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    public function setServiceLocator($serviceLocator)
    {
        $this->servicelocator = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->servicelocator;
    }
}
