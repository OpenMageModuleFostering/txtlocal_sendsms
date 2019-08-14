<?php
class txtlocal_sendsms_Block_Adminhtml_Sendsms extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_sendsms';
    $this->_blockGroup = 'sendsms';
    $this->_addButtonLabel = Mage::helper('sendsms')->__('Send Manual SMS');
    parent::__construct();
  }
}