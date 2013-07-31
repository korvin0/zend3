<?php
class Application_Model_User implements Zend_Acl_Role_Interface
{
    public $id = null;
    protected $_aclRoleId = null;
    
    public function __construct($id, $_aclRoleId='')
    {
      $this->id = $id;
      if (!empty($_aclRoleId)) $this->_aclRoleId = $_aclRoleId;
    }

    public function getRoleId()
    {
        if ($this->_aclRoleId == null) return 'guest';
        return $this->_aclRoleId;
    }



}