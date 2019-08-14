<?php

class txtlocal_sendsms_Block_Adminhtml_Sendsms_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('sendsms_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('sendsms')->__('SMS Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('sendsms')->__('SMS Information'),
          'title'     => Mage::helper('sendsms')->__('SMS Information'),
          'content'   => $this->getLayout()->createBlock('sendsms/adminhtml_sendsms_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}