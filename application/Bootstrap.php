<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _init23443()
    {
        $this->bootstrap('view');

        $view = $this->getResource('view');

        $view->doctype('HTML5');
    }
    
public function _initAcla(){
    Zend_Loader::loadClass('Acl');
    Zend_Loader::loadClass('CheckAccess');
    Zend_Controller_Front::getInstance()->registerPlugin(new CheckAccess());
    return new Acl();
} 

}

