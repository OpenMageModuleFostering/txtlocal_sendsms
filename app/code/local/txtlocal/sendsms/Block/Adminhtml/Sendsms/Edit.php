<?php

class txtlocal_sendsms_Block_Adminhtml_Sendsms_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
		
        $this->_objectId = 'id';
        $this->_blockGroup = 'sendsms';
        $this->_controller = 'adminhtml_sendsms';
        
        $this->_updateButton('save', 'label', Mage::helper('sendsms')->__('Send SMS'));
        $this->_updateButton('delete', 'label', Mage::helper('sendsms')->__('Delete Item'));
		
    }

    public function getHeaderText()
    {
        if( Mage::registry('sendsms_data') && Mage::registry('sendsms_data')->getId() ) {
            return Mage::helper('sendsms')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('sendsms_data')->getTitle()));
        } else {
            return Mage::helper('sendsms')->__('Send Manual SMS');
        }
    }
}