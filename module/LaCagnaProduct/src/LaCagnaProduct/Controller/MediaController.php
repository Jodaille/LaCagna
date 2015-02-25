<?php

namespace LaCagnaProduct\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class MediaController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }

    public function fetchimageAction()
    {
      $view = new ViewModel();
      $media_url  = $this->params()->fromPost('url', FALSE);
      $productName  = $this->params()->fromPost('productName', FALSE);

      $product_id  = $this->getRequest()->getQuery('product_id', false);
      if(!$product_id)
        $product_id  = $this->params()->fromPost('product_id', FALSE);


      $format = 300;
      $productManager = $this->getServiceLocator()->get('ProductManager');
      $medias = $productManager->Medias();
      $products = $productManager->Products();
      if($product_id)
      {
        $product = $products->get($product_id);
        if($product)
        {
          $title = $product->getTitle();
          $productName = \LaCagnaProduct\Model\Products::cleanString($title);
          $view->product = $product;
        }
      }
      $view->productName = $productName;

      $view->url = $media_url;
      $view->product_id = $product_id;

      if($this->request->isPost())
      {

        $localFile = $medias->fetchFromUrl($media_url);
        $destination_dir = 'public/img/';
        $imagefilename = $productName . '.png';//basename($localFile);
        //$imagefilename = basename($localFile);

        $imagefilename = str_replace(array('.svg'),'.png', $imagefilename);
        $view->localFile = $localFile;
        $view->img = $destination_dir . $imagefilename;
        $medias->mkThumb($localFile, $destination_dir . $imagefilename, $format);
        $media = $medias->addMedia(str_replace('public/', '/', $destination_dir) . $imagefilename);
        if($media)
        {
          $product = $products->setMainMedia($product, $media);
          $view->product = $product;
        }
      }

      return $view;
    }

}
