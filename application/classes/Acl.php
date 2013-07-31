<?php
class Acl extends Zend_Acl {
    public function  __construct() {
        //Добавляем роли
        $this->addRole('guest');
        $this->addRole('owner', 'guest');
        $this->addRole('admin', 'owner');

        

        // РЕСУРСЫ ПОЛЬЗОВАТЕЛЯ !
        $this->add(new Application_Model_BlogPost());
        //$this->add(new Zend_Acl_Resource('user/index'), 'user_allow');
        // ...

        // РЕСУРСЫ АДМИНА !
        $this->add(new Zend_Acl_Resource('admin_allow'));
        $this->add(new Zend_Acl_Resource('admin/index'), 'admin_allow');
        //...        

        //Выставляем права, по-умолчанию всё запрещено
        $this->deny(null, null, null);
        $this->allow('owner', new Application_Model_BlogPost(), 'publish', new OwnerCanPublishBlogPostAssertion());
        //$this->allow('guest', 'guest_allow', 'index');
        //$this->allow('user', 'user_allow', 'show');
        //$this->allow('admin','admin_allow', 'show');
    }

    public function can($privilege='show'){
        //Инициируем ресурс
        $request = Zend_Controller_Front::getInstance()->getRequest();
        //$resource = $request->getControllerName();
        //Если ресурс не найден закрываем доступ
        //if (!$this->has($resource)) return false;
        //Инициируем роль
        $storage_data = Zend_Auth::getInstance()->getStorage()->read();
        if (!$storage_data) $storage_data = array();
        $role = array_key_exists('status', $storage_data)?$storage_data->status : 'guest';
        
        $guestUser = new Application_Model_User(2, 'owner');
        $post = new Application_Model_BlogPost(3);
        if ($this->isAllowed($guestUser, $post, 'publish')) echo 'allow';
        else echo 'dis';
        
        return true;
        //return $this->isAllowed($role, $resource, $request->getActionName());
    }
}