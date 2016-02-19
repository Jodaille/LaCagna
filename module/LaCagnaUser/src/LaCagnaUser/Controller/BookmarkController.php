<?php

namespace LaCagnaUser\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Console\Request as ConsoleRequest;

class BookmarkController extends AbstractActionController
{

    public function toggleAction()
    {
        $view = new JsonModel();

        $productId = $this->params('productId', false);
        $bookmark = $this->getServiceLocator()->get('bookmark');
        $auth = $this->getServiceLocator()->get('zfcuser_auth_service');

        if ($auth->hasIdentity()) {
            $view->bookmarked = $bookmark->toggle(
                $productId, $auth->getIdentity()
                );
            $view->success = TRUE;
        }
        else
        {
            $view->success = FALSE;
        }

        return $view;
    }

    public function mybookmarksAction()
    {
        //$view = new ViewModel();
        $view = new JsonModel();

        $bookmark = $this->getServiceLocator()->get('bookmark');
        $auth = $this->getServiceLocator()->get('zfcuser_auth_service');
        $aBookmarks = $bookmark->getUserBookmarks($auth->getIdentity());

        $view->bookmarks = $aBookmarks;
        return $view;
    }

}
