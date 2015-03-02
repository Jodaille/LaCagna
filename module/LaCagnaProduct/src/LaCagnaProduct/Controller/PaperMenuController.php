<?php

namespace LaCagnaProduct\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DOMPDFModule\View\Model\PdfModel;

class PaperMenuController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }

    public function generatepdfAction()
    {
      $pdf = new PdfModel();
      $categories     = $this->getServiceLocator()->get('Categories');
      $categoriesList = $categories->getList();
      $listCategoriesAsTree = $categories->listCategoriesAsTree();

      $pdf->setVariables(array(
        'categories' => $categoriesList,
      ));
      $pdf->setOption("filename", "Menu_LaCagna");
      $pdf->setOption("paperSize", "a4"); //Defaults to 8x11
      $pdf->setOption("paperOrientation", "landscape"); //Defaults to portrait

      return $pdf;
    }


}
