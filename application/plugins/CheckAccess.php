<?php
class CheckAccess extends Zend_Controller_Plugin_Abstract {
    /**
     * �����1 preDispatch ��������� �������� ���� ������� ��
     * ������ controller/action � ������ ������ �������� �����
     * generateAccessError
     * 
     * @param Zend_Controller_Request_Abstract $request
     */
    public function  preDispatch(Zend_Controller_Request_Abstract $request) {
        $acl = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('Acl');
        if (!$acl->can()){
            $this->generateAccessError();
        }
    }

    /**
     * ����� ��������� ��������� � ������ ���� �������.
     * ��������� ��������������� �� ���������� error � ������� � ��
     * ��������� � ������ ������������ � �����.
     * 
     * @param string $msg
     */
    public function generateAccessError($msg='������ ��������!'){
        $request = $this->getRequest();
        $request->setControllerName ('error');
        $request->setActionName('error');
        $request->setParam('message', $msg);
    }
}