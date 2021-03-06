<?php

namespace LaCagnaAdviseMe\Controller;

use Zend\Mvc\Controller\AbstractActionController;

use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

use Zend\Console\Request as ConsoleRequest;

use Zend\Console\Prompt;
use Zend\Console\Prompt\Line;
use Zend\Console\Prompt\Select;
use Zend\Console\ColorInterface;

class AdviseMeController extends AbstractActionController
{

    public function indexAction()
    {

        $advise = $this->getServiceLocator()->get('advise');
        $auth = $this->getServiceLocator()->get('zfcuser_auth_service');
        $view = new ViewModel();

        if ($auth->hasIdentity()) {
            $products = $advise->userAdvise($auth->getIdentity()->getId());
        }
        else
        {
            $products = $advise->simpleAdvise();
        }
        $products = $advise->getTopN($products, false);
        $view->products = $products;
        return $view;
    }

    public function getadviseAction()
    {

        $advise = $this->getServiceLocator()->get('advise');
        $auth = $this->getServiceLocator()->get('zfcuser_auth_service');
        $view = new JsonModel();

        if ($auth->hasIdentity()) {
            $products = $advise->userAdvise($auth->getIdentity()->getId());
        }
        else
        {
            $products = $advise->simpleAdvise();
        }
        $products = $advise->increaseProbability($products);
        $products = $advise->getTopN($products, false);
        $view->products = $products;
        return $view;
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
        $products = $advise->getTopN($products, 15);

        foreach($products as $advice)
        {
            $console->writeLine('productId: ' . $advice['product_id']
                        . ' score: ' . $advice['score'], ColorInterface::BLUE);
            $console->writeLine('media_slug: ' . $advice['media_slug']
                                , ColorInterface::GREEN);


        }

        return new ViewModel();
    }


}
