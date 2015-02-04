<?php

namespace LaCagnaProduct\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AdminController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }

    public function addcategoryAction()
    {
        return new ViewModel();
    }

    public function qrcodeAction()
    {
        $url = 'http://lacagna.jodaille.org';
        $img = "/img/qrcode.png";
        $destination_dir = "./public";
        //($text, $outfile = false, $level = Constants::QR_ECLEVEL_L, $size = 3, $margin = 4, $saveandprint=false)
        \PHPQRCode\QRcode::png($url, $destination_dir . $img, 'L', 10, 2);
        die('<img src="' . $img . '" />');
    }

    public function productlistingAction()
    {
        $productsListing    = $this->getServiceLocator()->get('ProductsListing');
        $productsList       = $productsListing->getList();

        return new ViewModel(
            array(
                'products' => $productsList
            )
        );
    }

    public function categorylistingAction()
    {
        $categories     = $this->getServiceLocator()->get('Categories');
        $categoriesList = $categories->getList();

        return new ViewModel(
        array(
            'categories' => $categoriesList
            )
        );
    }

    public function editcategoryAction()
    {
        if (!$this->isAllowed('product', 'add')) {
            throw new \BjyAuthorize\Exception\UnAuthorizedException('Grow a beard first!');
        }
        $categories = $this->getServiceLocator()->get('Categories');
        $id         = $this->params('id',false);
        $posted_id  = $this->params()->fromPost('id', FALSE);

        if($this->request->isPost())
        {
            $values['code']         = $this->params()->fromPost('code', FALSE);
            $values['title']        = $this->params()->fromPost('title', FALSE);
            $values['displayorder'] = $this->params()->fromPost('displayorder', FALSE);

            $category               = $categories->edit($id, $values);
        }
        else
        {
            $category   = $categories->get($id);
        }


        return new ViewModel(
                            array(
                                'category' => $category
                                )
        );
    }

    public function editproductAction()
    {
        if (!$this->isAllowed('product', 'add'))
        {
            throw new \BjyAuthorize\Exception\UnAuthorizedException('Grow a beard first!');
        }
        $productManager = $this->getServiceLocator()->get('ProductManager');
        $products       = $productManager->Products();
        $categories     = $productManager->Categories();
        $ingredients    = $productManager->Ingredients();

        $types      = $productManager->Types();
        $states     = $productManager->States();
        $id         = $this->params('id',false);
        $posted_id  = $this->params()->fromPost('id', FALSE);

        if($this->request->isPost())
        {
            $values['code']         = $this->params()->fromPost('code', FALSE);
            $values['title']        = $this->params()->fromPost('title', FALSE);
            $values['description']  = $this->params()->fromPost('description', FALSE);
            $values['type']         = $this->params()->fromPost('type', FALSE);
            $values['state']        = $this->params()->fromPost('state', FALSE);
            $values['categories']   = $this->params()->fromPost('categories', FALSE);
            $values['ingredients']  = $this->params()->fromPost('ingredients', FALSE);

            $product                = $products->edit($posted_id, $values);
        }
        else
        {
            $product   = $products->get($id);
        }

        return new ViewModel(
                    array(
                        'product'       => $product,
                        'types'         => $types->getList(),
                        'states'        => $states->getList(),
                        'categories'    => $categories->getProductList($product),
                        'ingredients'   => $ingredients->getProductList($product),
                        )
                    );
    }

    public function ingredientslistingAction()
    {
        $productManager = $this->getServiceLocator()->get('ProductManager');
        $ingredients    = $productManager->Ingredients();
        return new ViewModel(
        array(
            'ingredients'   => $ingredients->getList(),
            )
        );
    }

    public function editingredientAction()
    {
        if (!$this->isAllowed('product', 'add')) {
            throw new \BjyAuthorize\Exception\UnAuthorizedException('Grow a beard first!');
        }
        $productManager = $this->getServiceLocator()->get('ProductManager');
        $ingredients    = $productManager->Ingredients();

        $id             = $this->params('id',false);
        $posted_id      = $this->params()->fromPost('id', FALSE);

        if($this->request->isPost())
        {
            $values['name'] = $this->params()->fromPost('name', FALSE);
            $ingredient     = $ingredients->edit($id, $values);
        }
        else
        {
            $ingredient   = $ingredients->get($id);
        }


        return new ViewModel(
            array(
                'ingredient' => $ingredient
            )
        );
    }


}
