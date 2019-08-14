<?php

class txtlocal_sendsms_Block_Adminhtml_Sendsms_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('sendsms_form', array('legend'=>Mage::helper('sendsms')->__('SMS information')));

      $fieldset->addField('from', 'text', array(
          'label'     => Mage::helper('sendsms')->__('From'),
          'required'  => true,
          'name'      => 'from',
		  'after_element_html' => '<br/><small>'.Mage::helper('sendsms')->__('Name or Telephone').'</small>',
      ));
	  
	  $fieldset->addField('to', 'text', array(
          'label'     => Mage::helper('sendsms')->__('To (or Order number)'),
          'required'  => true,
          'name'      => 'to',
		  'after_element_html' => '<br/><small>'.Mage::helper('sendsms')->__('Telephone (ex: +40740123456 or 100000001)').'</small>',
      ));
	  
      $fieldset->addField('sms_message', 'editor', array(
          'name'      => 'sms_message',
          'label'     => Mage::helper('sendsms')->__('Message'),
          'title'     => Mage::helper('sendsms')->__('Message'),
          'style'     => 'width:274px; height:15em;',
		  'after_element_html' => Mage::helper('sendsms')->__('Message Template (160 characters)'),
          'wysiwyg'   => false,
          'required'  => true,
      ));

      if ( Mage::getSingleton('adminhtml/session')->getSendsmsData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getSendsmsData());
          Mage::getSingleton('adminhtml/session')->setSendsmsData(null);
      } elseif ( Mage::registry('sendsms_data') ) {
          $form->setValues(Mage::registry('sendsms_data')->getData());
      }
      return parent::_prepareForm();
  }
}