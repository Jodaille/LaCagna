<?php

namespace LaCagnaUser\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AdminController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }

    public function listAction()
    {
        $view = new ViewModel();
        $UserAdmin = $this->getServiceLocator()->get('UserAdmin');
        $view->users = $UserAdmin->getList();
        return $view;
    }

    public function editAction()
    {
        $view = new ViewModel();
        $userId  = $this->params()->fromPost('id',$this->params('id', false));

        $UserAdmin = $this->getServiceLocator()->get('UserAdmin');
        $view->user = $UserAdmin->getUser($userId);

        if($this->request->isPost())
        {
            $aParams['user_id'] = $userId;
            $aParams['user_name'] = $this->params()->fromPost('name', FALSE);
            $aParams['user_email'] = $this->params()->fromPost('email', FALSE);
            $aParams['user_display_name'] = $this->params()->fromPost('display_name', FALSE);

            //$UserAdmin->updateUser($aParams);
            $view->user = $UserAdmin->updateUser($aParams);
            $this->flashMessenger()
                ->addMessage(' user mis à jour :-)');
        }

        return $view;

    }


}
