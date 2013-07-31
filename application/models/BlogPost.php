<?php
class Application_Model_BlogPost implements Zend_Acl_Resource_Interface

{
public function __construct($id=4)
{
  $this->id = $id;
}
    public function getResourceId()
    {
        return 'blogPost';
    }

}
?>