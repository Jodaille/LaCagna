<?php

namespace LaCagnaProduct\Model;

use Zend\ServiceManager\ServiceLocatorAwareInterface;


class Categories
{
    protected $em;
    protected $servicelocator;


    public function getList()
    {
        $categoryRepository = $this->getEntityManager()
                                ->getRepository('LaCagnaProduct\Entity\Category');

        return $categoryRepository->findAll();
    }

    public function getProductList($product)
    {
        $categories = array();
        if($product)
        {
            foreach($product->getCategories() as $category)
            {
                $categories[$category->getId()] = array(
                    'id'        => $category->getId(),
                    'title'     => $category->getTitle(),
                    'selected'  => true,
                );
            }
        }

        foreach($this->getList() as $category)
        {
            if(!isset($categories[$category->getId()]))
            {
                $categories[$category->getId()] = array(
                    'id' => $category->getId(),
                    'title' => $category->getTitle(),
                );
            }
        }
        return $categories;
    }

    public function get($id)
    {
        return $categoryRepository = $this->getEntityManager()
        ->getRepository('LaCagnaProduct\Entity\Category')
        ->find($id);
    }

    public function edit($id = false, $values)
    {
        $category = false;
        $categoryRepository = $this->getEntityManager()
                            ->getRepository('LaCagnaProduct\Entity\Category');
        //echo '<pre>'; var_dump($id, $values);die();
        if($id)
        {
            $category = $categoryRepository->find($id);
        }
        if(!$category)
            $category = new \LaCagnaProduct\Entity\Category();

        $code           = $values['code'];
        $title          = $values['title'];
        $displayorder   = $values['displayorder'];

        if(empty($code))
            $code = preg_replace("/[^A-Za-z0-9]/", "", $title);

        $category->setCode($code);
        $category->setTitle($title);
        $category->setDisplayorder($displayorder);

        $this->getEntityManager()->persist($category);
        $this->getEntityManager()->flush();

        return $category;
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
