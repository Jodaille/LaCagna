<?php

namespace LaCagnaProduct\Model;

use Zend\ServiceManager\ServiceLocatorAwareInterface;


class Ingredients
{
    protected $em;
    protected $servicelocator;

    public function get($id)
    {
        return $ingredientRepository = $this->getEntityManager()
                            ->getRepository('LaCagnaProduct\Entity\Ingredient')
                            ->find($id);
    }

    public function edit($id = false, $values)
    {
        $ingredient = false;
        $ingredientRepository = $this->getEntityManager()
                            ->getRepository('LaCagnaProduct\Entity\Ingredient');

        if($id)
        {
            $ingredient = $ingredientRepository->find($id);
        }

        if(!$ingredient)
        $ingredient = new \LaCagnaProduct\Entity\Ingredient();

        $name           = $values['name'];

        $ingredient->setName($name);

        $this->getEntityManager()->persist($ingredient);
        $this->getEntityManager()->flush();

        return $ingredient;
    }

    public function getList()
    {
        $repository = $this->getEntityManager()
                           ->getRepository('LaCagnaProduct\Entity\Ingredient');
        return $repository->findAll();
    }

    public function getProductList($product)
    {
        $ingredients = array();
        if($product)
        {
            foreach($product->getIngredients() as $ingredient)
            {
                $ingredients[$ingredient->getId()] = array(
                    'id'        => $ingredient->getId(),
                    'name'     => $ingredient->getName(),
                    'selected'  => true,
                );
            }
        }

        foreach($this->getList() as $ingredient)
        {
            if(!isset($ingredients[$ingredient->getId()]))
            {
                $ingredients[$ingredient->getId()] = array(
                    'id' => $ingredient->getId(),
                    'name' => $ingredient->getName(),
                );
            }
        }
        return $ingredients;
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
