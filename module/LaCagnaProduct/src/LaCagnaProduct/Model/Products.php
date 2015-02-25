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
        $CategoryRepository = $this->getEntityManager()
                            ->getRepository('LaCagnaProduct\Entity\Category');
        $IngredientRepository = $this->getEntityManager()
                            ->getRepository('LaCagnaProduct\Entity\Ingredient');

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
        $categories     = $values['categories'];
        $ingredients    = $values['ingredients'];

        foreach($Product->getCategories() as $category)
        {
            $Product->removeCategory($category);
        }
        if($categories)
        {
            foreach($categories as $category_id)
            {
                $category = $CategoryRepository->find($category_id);
                if($category)
                    $Product->addCategory($category);
            }
        }

        foreach($Product->getIngredients() as $ingredient)
        {
            $Product->removeIngredient($ingredient);
        }
        if($ingredients)
        {
            foreach($ingredients as $ingredient_id)
            {
                $ingredient = $IngredientRepository->find($ingredient_id);
                if($ingredient)
                    $Product->addIngredient($ingredient);
            }
        }
        if(empty($code))
            $code = self::cleanString($title);

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

    public function setMainMedia($product, $media)
    {
      $product->setMainmedia($media);
      $this->getEntityManager()->persist($product);
      $this->getEntityManager()->flush();
      return $product;
    }

    public static function cleanString($text) {
        $utf8 = array(
            '/[áàâãªä]/u'   =>   'a',
            '/[ÁÀÂÃÄ]/u'    =>   'A',
            '/[ÍÌÎÏ]/u'     =>   'I',
            '/[íìîï]/u'     =>   'i',
            '/[éèêë]/u'     =>   'e',
            '/[ÉÈÊË]/u'     =>   'E',
            '/[óòôõºö]/u'   =>   'o',
            '/[ÓÒÔÕÖ]/u'    =>   'O',
            '/[úùûü]/u'     =>   'u',
            '/[ÚÙÛÜ]/u'     =>   'U',
            '/ç/'           =>   'c',
            '/Ç/'           =>   'C',
            '/ñ/'           =>   'n',
            '/Ñ/'           =>   'N',
            '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
            '/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
            '/[“”«»„]/u'    =>   ' ', // Double quote
            '/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
        );
        $string = preg_replace(array_keys($utf8), array_values($utf8), $text);
        $string = strtolower($string);
        $string = preg_replace(
          array( '#[\\s-]+#', '#[^A-Za-z0-9\. -]+#' ),
          array( '-', '' ),
          $string);
        return $string;
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
