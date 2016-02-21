<?php

namespace LaCagnaAdviseMe\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Console\Request as ConsoleRequest;

use Zend\Console\Prompt;
use Zend\Console\Prompt\Line;
use Zend\Console\Prompt\Select;
use Zend\Console\ColorInterface;

class AdviseMeController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }

    public function bestAdviceAction()
    {
        $request  = $this->getRequest();
        $verbose  = $request->getParam('verbose');
        $console  = $this->getServiceLocator()->get('console');
        $userId   = $request->getParam('userId', false);


        $advise = $this->getServiceLocator()->get('advise');
        if($userId)
        {
            $products = $advise->userAdvise($userId);
        }
        else
        {
            $products = $advise->simpleAdvise();
        }
        $products = $advise->getTopN($products, 10);

        foreach($products as $advice)
        {
            $console->writeLine('productId: ' . $advice['product_id']
            . ' score: ' . $advice['score'], ColorInterface::BLUE);

        }

        return new ViewModel();
    }


}
