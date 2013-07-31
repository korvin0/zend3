<?php
// 111
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initDoctype()
    {
        $this->bootstrap('view');

        $view = $this->getResource('view');

        $view->doctype('HTML5');
      $this->bootstrap('db');
    	$db = $this->getResource('db');
      Zend_Registry::set('db', $db);

    }
    
public function _initAcl(){
    Zend_Loader::loadClass('Acl');
    Zend_Loader::loadClass('CheckAccess');
    Zend_Loader::loadClass('OwnerCanPublishBlogPostAssertion');
    Zend_Controller_Front::getInstance()->registerPlugin(new CheckAccess());
    return new Acl();
} 

}

