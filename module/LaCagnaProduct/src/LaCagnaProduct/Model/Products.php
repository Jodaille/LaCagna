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
        //echo '<pre>'; var_dump($id, $values);die();
        if($id)
        {
            $Product = $ProductRepository->find($id);
        }
        if(!$Product)
            $Product = new \LaCagnaProduct\Entity\Product();

        $code           = $values['code'];
        $title          = $values['title'];
        $displayorder   = $values['displayorder'];
        $description    = $values['description'];

        if(empty($code))
            $code = preg_replace("/[^A-Za-z0-9]/", "", $title);

        $Product->setCode($code);
        $Product->setTitle($title);
        $Product->setDisplayorder($displayorder);
        $Product->setDescription($description);

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
