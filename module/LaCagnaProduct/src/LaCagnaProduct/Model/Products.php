<?php

namespace LaCagnaProduct\Model;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use LaCagnaProduct\Entity\Article as Article;
use LaCagnaProduct\Entity\Price as Price;
use LaCagnaProduct\Entity\CharacteristicValue as CharacteristicValue;
use LaCagnaProduct\Entity\Characteristic as Characteristic;


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

    public function getProductArticleWithCharac($productid, $charac, $value, $limit = 1)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->add('select', 'a')
            ->add('from', 'LaCagnaProduct\Entity\Article a')
            ->leftJoin('a.products', 'p');
        $qb->leftJoin('a.characteristicsvalues', 'values');
        $qb->leftJoin('values.characteristic', 'characteristic');

        $qb->leftJoin('a.prices', 'prices');

        $qb->andWhere('p.id = :productid');
        $qb->andWhere('values.value = :value');
        $qb->andWhere('characteristic.abbreviation = :charac')

            ->setParameter(':value', $value)
            ->setParameter(':charac', $charac)

            ->setParameter(':productid', $productid);

        $qb->orderBy('values.value', 'ASC');
        if($limit == 1)
        {
            $qb->setMaxResults($limit);
            $query = $qb->getQuery();
            $results = $query->getOneOrNullResult();
        }
        else
        {
            if($limit)
                $qb->setMaxResults($limit);
            $query = $qb->getQuery();
            $results = $query->getResult();
        }

        return $results;
    }

    public function getArticleWithVolume($productid, $volume, $limit = 1)
    {
        $results = $this->getProductArticleWithCharac($productid, 'Volume', $volume, $limit);
        return $results;
    }

    public function addArticleVolume($productid, $volume)
    {
        $article = $this->getArticleWithVolume($productid, $volume);

        //\Doctrine\Common\Util\Debug::dump($article);die();
        if(!$article)
        {
            $p_repository = $this->getEntityManager()
                                ->getRepository('LaCagnaProduct\Entity\Product');
            $a_repository = $this->getEntityManager()
                                ->getRepository('LaCagnaProduct\Entity\Article');

            $p = $p_repository->find($productid);
            $pcode = $p->getCode();
            $acode = $pcode . $volume;
            $article = $a_repository->findOneByCode($acode);
            if(!$article)
                $article = new Article();
            $article->setCode($acode);

            if($p->getArticles() && !$p->getArticles()->contains($article))
            {
                $p->addArticle($article);
            }

            $this->getEntityManager()->persist($article);
            $this->getEntityManager()->persist($p);
            $value = $this->addCharacteristic('Volume', $volume);
            if($article->getCharacteristicsvalues() &&
                !$article->getCharacteristicsvalues()->contains($value))
            {
                $article->addCharacteristicsvalue($value);
            }
            $this->getEntityManager()->flush();
        }
        return $article;
    }

    public function addVolumePrice($productid, $volume, $priceValue, $specialPrice = false)
    {
        $article = $this->addArticleVolume($productid, $volume);
        foreach($article->getPrices() as $price)
        {
            $this->getEntityManager()->remove($price);
        }
        $this->getEntityManager()->flush();

        $this->getEntityManager()->persist($article);
        $price = new Price();
        $price->setValue($priceValue);
        if($specialPrice)
            $price->setSpecialValue($specialPrice);
        $price->setArticle($article);

        $this->getEntityManager()->persist($price);
        $this->getEntityManager()->persist($article);
        $this->getEntityManager()->flush();
        return $article;
    }

    public function addCharacteristic($abbreviation = 'Volume', $value)
    {
        $repository = $this->getEntityManager()->getRepository('LaCagnaProduct\Entity\Characteristic');

        $charac = $repository->getCharacteristicValue($abbreviation, $value);

    //\Doctrine\Common\Util\Debug::dump($charac);die();
        if(!$charac)
        {
            $cvalue = new CharacteristicValue();
            $cvalue->setValue($value);
            $charac = $this->getCharacteristic($abbreviation);

        }
        else
        {
            $cvalues = $charac->getCharacteristicsvalues();
            if($cvalues)
                $cvalue = $cvalues->first();
        }
        $cvalue->setCharacteristic($charac);
        $this->getEntityManager()->persist($cvalue);
        $this->getEntityManager()->flush();
        return $cvalue;
    }

    public function getCharacteristic($abbreviation = 'Volume')
    {
        $repository = $this->getEntityManager()->getRepository('LaCagnaProduct\Entity\Characteristic');
        $charac = $repository->findOneByAbbreviation($abbreviation);
        if(!$charac)
        {
            $charac = new Characteristic();
            $charac->setAbbreviation($abbreviation);
            $this->getEntityManager()->persist($charac);
            $this->getEntityManager()->flush();
        }
        return $charac;
    }


    public function editArticle($id = false, $product, $values)
    {
        $ArticleRepository = $this->getEntityManager()
                            ->getRepository('LaCagnaProduct\Entity\Article');
        /*
        $values['volume']
        $values['price']
        $values['specialPrice']
        */
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
