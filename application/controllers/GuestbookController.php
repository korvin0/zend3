<?php

class GuestbookController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
      $loginForm = new Application_Form_Auth_Login();
        if ($this->getRequest()->isPost()) {
          
          $form = $loginForm;
          if (!$form->isValid($_POST)) {
              // Failed validation; redisplay form
              $this->view->loginForm = $form;
              //return $this->render('form');
          }
          else
          {
            $values = $form->getValues();
            
            $db = Zend_Registry::get('db');
            $select = $db->select()->from('guestbook');
            $gg = new Application_Model_GuestbookMapper();
            $roset = $gg->fetchAll($select);
            foreach ($roset as $v) echo $v->id.'<Br>';
          }
        }

        
        $guestbook = new Application_Model_GuestbookMapper();

        $select = $guestbook->fetchAll();
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('controls.phtml');
        
        //$db = Zend_Registry::get('db');
        //$select = $db->select()->from('posts')->sort('date_created DESC');
        $paginator = Zend_Paginator::factory($select);
        
        $paginator->setCurrentPageNumber($this->_getParam('page', 1));
        $paginator->setItemCountPerPage(5);
        $paginator->setView(Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('view'));
        
        $this->view->paginator = $paginator;
        
        $this->view->loginForm = $loginForm;
        
    }


}

