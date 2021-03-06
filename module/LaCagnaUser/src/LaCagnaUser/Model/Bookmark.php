<?php
/**
 * User Bookmark model class
 *
 * @package Model
 */

namespace LaCagnaUser\Model;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use LaCagnaUser\Entity\Bookmark as Favorite;

class Bookmark implements ServiceLocatorAwareInterface
{
	protected $em;
    protected $servicelocator;
	public function getUserBookmarks($user)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('b')
            ->from('LaCagnaUser\Entity\Bookmark', 'b')
            ->where('b.user = :user')
            ->setParameters(
                array(':user' => $user,
                      )
                );
        $qb->orderBy('b.updated_at', 'DESC');
        $query = $qb->getQuery();
        $results = $query->getResult();
        $aBookmarks = array();
        if($results)
        {
            foreach($results as $b)
            {
                $product = $b->getProduct();
                $title = $product->getTitle();
                $id = $product->getId();
                $media = $product->getMainmedia();
                $slug = null;
                if($media)
                {
                    $slug = $media->getSlug();
                }
                $aBookmarks[] = ['title' => $title,
                'product_id' => $id,
                'slug' => $slug,
                ];
            }
        }
        return $aBookmarks;
    }

	public function toggle($productId, $user)
	{
		$product = $this->_getProduct($productId);
		if($this->isProductBookmarked($user, $product))
		{
			$this->remove($product, $user);
			return false;
		}
		else
		{
			$this->add($product, $user);
			return true;
		}
	}

	public function add($product, $user = false)
	{
		if(!$user)
		{
			return FALSE;
		}


		$bookmark = $this->_getBookmark($product, $user);

		if(!$bookmark)
		{
        	$bookmark = new Favorite();
		}

        $bookmark->setUser($user);
        $bookmark->setProduct($product);

        $this->getEntityManager()->persist($bookmark);
        $this->getEntityManager()->flush();

		return $bookmark;

	}

	public function remove($product, $user = false)
	{
		if(!$user)
		{
			return FALSE;
		}

		$bookmark = $this->_getBookmark($product, $user);
		if($bookmark)
		{
	        $this->getEntityManager()->remove($bookmark);
	        $this->getEntityManager()->flush();
		}
	}

	public function isProductBookmarked($user, $product)
    {
		return $this->_getBookmark($product, $user);
    }

	private function _getBookmark($product, $user)
	{
		$bookmark = $this->getEntityManager()->getRepository('LaCagnaUser\Entity\Bookmark')->findOneBy(
			['user' => $user, 'product' => $product]
		);
		return $bookmark;
	}

	private function _getProduct($productId)
	{
		$product = $this->getEntityManager()
				->getRepository('LaCagnaProduct\Entity\Product')
				->find($productId);
		return $product;
	}

    public function getEntityManager()
    {
        if (null === $this->em)
        {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->servicelocator = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->servicelocator;
    }

}
