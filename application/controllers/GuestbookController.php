<?php

class GuestbookController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $guestbook = new Application_Model_GuestbookMapper();

        $this->view->entries = $guestbook->fetchAll();
        
        $modelGuestbook = new Application_Model_Guestbook();
        
        $guestbook->find(2, $modelGuestbook);
        
        echo $modelGuestbook->getId();exit;
        
    }


}

