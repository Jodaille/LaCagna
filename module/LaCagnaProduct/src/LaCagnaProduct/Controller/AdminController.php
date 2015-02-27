<?php

namespace LaCagnaProduct\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Console\Request as ConsoleRequest;

class AdminController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }
    public function addcategoryAction()
    {
      $categories = $this->getServiceLocator()->get('Categories');
      $request = $this->getRequest();

      if (!$request instanceof ConsoleRequest)
      {
        $title  = $this->params()->fromPost('title', FALSE);
      }
      else
      {
        $title  = $request->getParam('title');
      }
      $values   = array('title' => $title);
      $category = $categories->edit(false, $values);

      return new ViewModel();
    }

    public function parentcategoryAction()
    {
      $categories = $this->getServiceLocator()->get('Categories');
      $request = $this->getRequest();

      if (!$request instanceof ConsoleRequest)
      {
        $cid        = $this->params()->fromPost('category_id', FALSE);
        $parent_id  = $this->params()->fromPost('parent_id', FALSE);
      }
      else
      {
        $cid        = $request->getParam('category_id');
        $parent_id  = $request->getParam('parent_id');
      }

      $categories->chooseParent($cid, $parent_id);
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
        $listCategoriesAsTree = $categories->listCategoriesAsTree();
        return new ViewModel(
          array(
              'categories' => $categoriesList,
              'listCategoriesAsTree' => $listCategoriesAsTree,
              )
        );
    }


    public function productsCategoryAction()
    {
      $id         = $this->params('id', false);
      $categories = $this->getServiceLocator()
                    ->get('Categories');
      $products   = $categories->productsCategory($id);
      return new ViewModel(
        array(
            'products' => $products,
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

    public function createrootAction()
    {
        $request = $this->getRequest();

        // Make sure that we are running in a console and the user has not tricked our
        // application into running this action from a public web server.
        if (!$request instanceof ConsoleRequest){
            throw new \RuntimeException('You can only use this action from a console!');
        }

        // Get category title from console and check if we used --verbose or -v flag
        $categoryTitle  = $request->getParam('categoryTitle');
        $verbose        = $request->getParam('verbose') || $request->getParam('v');
        $productManager = $this->getServiceLocator()->get('ProductManager');

        $categories     = $productManager->Categories();
        $category = $categories->createRoot($categoryTitle);

        if($category)
            return "Category created\n";
        else
            return "Category not created\n";
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
