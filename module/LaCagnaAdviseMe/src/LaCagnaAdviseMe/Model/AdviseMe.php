<?php

namespace LaCagnaAdviseMe\Model;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Doctrine\ORM\Query\ResultSetMapping;

class AdviseMe
{
    protected $em;
    protected $servicelocator;

    public function simpleAdvise()
    {
        $products = $this->getProducts();
        $aAdvise = array();
        foreach($products as $p)
        {
            $score = 1;
            $advise = $this->getProductData($p, $score);
            $aAdvise[] = $advise;
        }

        return $aAdvise;
    }

    public function userAdvise($user_Id, $iNbELements = 3)
    {
        $user = $this->getEntityManager()
        ->getRepository('LaCagnaUser\Entity\User')
        ->find($user_Id);

        $bookmark = $this->getServiceLocator()->get('bookmark');


        $products = $this->getProducts();
        $aAdvise = array();
        foreach($products as $p)
        {
            $score = 1;
            if($bookmark->isProductBookmarked($user, $p))
            {
                $score++;
            }
            $advise = $this->getProductData($p, $score);
            $aAdvise[] = $advise;
        }

        return $aAdvise;
    }

    public function getProductData($product, $score)
    {
        $slug = null;
        $media = $product->getMainmedia();
        if($media)
        {
            $slug = $media->getSlug();
        }
        if($slug)
        {
            $score++;
        }
        $data = [
            'product_id' => $product->getId(),
            'media_slug' => $slug,
            'score' => $score,
            ];
        return $data;
    }

    /**
    * Get top product sorted by score
    * @param array $aAdvise
    * @param int $iNbELements
    */
    public function getTopN($aAdvise, $iNbELements = 3)
    {
        uasort($aAdvise, self::sortByScore());
        if($iNbELements)
        {
            $aAdvise = array_slice($aAdvise, 0, $iNbELements);
        }
        return $aAdvise;
    }

    public static function sortByScore($key = 'score') {
        return
            function ($a, $b) use ($key) {
                if (!isset($a[$key])) {
                    return 1;
                }

                if (!isset($b[$key])) {
                    return 1;
                }
                return ($a[$key] < $b[$key]) ? 1 : -1;
            };

    }

    public function getProducts()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->add('select', 'p')
            ->add('from', 'LaCagnaProduct\Entity\Product p');
        $qb->orderBy('p.title', 'ASC');
        $qb->addOrderBy('p.created_at', 'DESC');

        $query = $qb->getQuery();
        $results = $query->getResult();
        return $results;
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
