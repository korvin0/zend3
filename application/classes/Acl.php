<?php
class Acl extends Zend_Acl {
    public function  __construct() {
        //��������� ����
        $this->addRole('guest');
        $this->addRole('user', 'guest');
        $this->addRole('admin', 'user');

        //��������� �������
        // ������� ����� !
        $this->add(new Zend_Acl_Resource('guest_allow'));
        $this->add(new Zend_Acl_Resource('indexa'),'guest_allow');
        $this->add(new Zend_Acl_Resource('index'),'guest_allow');
        //...

        // ������� ������������ !
        $this->add(new Zend_Acl_Resource('user_allow'));
        $this->add(new Zend_Acl_Resource('user/index'), 'user_allow');
        // ...

        // ������� ������ !
        $this->add(new Zend_Acl_Resource('admin_allow'));
        $this->add(new Zend_Acl_Resource('admin/index'), 'admin_allow');
        //...        

        //���������� �����, ��-��������� �� ���������
        $this->deny(null, null, null);
        $this->allow('guest', 'guest_allow', 'index');
        $this->allow('user', 'user_allow', 'show');
        $this->allow('admin','admin_allow', 'show');
    }

    public function can($privilege='show'){
        //���������� ������
        $request = Zend_Controller_Front::getInstance()->getRequest();
        $resource = $request->getControllerName();
        //���� ������ �� ������ ��������� ������
        if (!$this->has($resource)) return false;
        //���������� ����
        $storage_data = Zend_Auth::getInstance()->getStorage()->read();
        if (!$storage_data) $storage_data = array();
        $role = array_key_exists('status', $storage_data)?$storage_data->status : 'guest';
        return $this->isAllowed($role, $resource, $request->getActionName());
    }
}