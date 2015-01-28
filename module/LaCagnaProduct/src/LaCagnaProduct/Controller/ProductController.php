<?php
/**
* Zend Framework (http://framework.zend.com/)
*
* @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
* @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
* @license   http://framework.zend.com/license/new-bsd New BSD License
*/

namespace LaCagnaProduct\Controller;
use Zend\Mvc\Controller\AbstractActionController;;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;


class ProductController extends AbstractActionController
{
    protected $em;

    public function bytypeAction()
    {
        $type = $this->params('type', false);
        $productsListing = $this->getServiceLocator()->get('ProductsListing');
        $products = $productsListing->byType($type);
        //\Doctrine\Common\Util\Debug::dump($cocktails);
        return array('products' => $products);
    }



    public function indexAction()
    {
        $id   = $this->params()->fromPost('id', FALSE);
        $name = $this->params('name', FALSE);
        $cocktailFactory = $this->getServiceLocator()->get('cocktail');
        $cocktail = $cocktailFactory->get($name);
        return array('cocktail' => $cocktail);
    }
    public function addAction()
    {
        /**
        * get data from our form
        */
        $id          = $this->params()->fromPost('id', FALSE);
        $name        = $this->params()->fromPost('name', FALSE);
        $type        = $this->params()->fromPost('type', FALSE);

        $cocktailRepository = $this->getEntityManager()->getRepository('LaCagnaProduct\Entity\Cocktail');

        // initialize view result
        $viewElements = array();

        // in case we receive something from form
        if($this->request->isPost() && $name)
        {

            $cocktail = $cocktailRepository->find($id);

            // We cannot find catalog: create a new one
            if(!$cocktail)
            {
                $cocktail = new \LaCagnaProduct\Entity\Cocktail();
            }

            // Change properties
            $cocktail->setName($name);
            //$cocktail->setVersion($catalogversion);

            // apply modifications
            $this->getEntityManager()->persist($cocktail);

            // save data to database
            $this->getEntityManager()->flush();

            // assign result to view
            $viewElements = array('cocktail' => $cocktail);
        }

        return new ViewModel($viewElements);
    }

    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }
}
