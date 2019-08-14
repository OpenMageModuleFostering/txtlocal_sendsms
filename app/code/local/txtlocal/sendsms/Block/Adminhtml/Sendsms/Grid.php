<?php

class txtlocal_sendsms_Block_Adminhtml_Sendsms_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('sendsmsGrid');
      $this->setDefaultSort('sendsms_id');
      $this->setDefaultDir('DESC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('sendsms/sendsms')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('sendsms_id', array(
          'header'    => Mage::helper('sendsms')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'sendsms_id',
      ));

      $this->addColumn('order_id', array(
          'header'    => Mage::helper('sendsms')->__('Order Id'),
          'align'     =>'left',
          'index'     => 'order_id',
      ));
	  
	  $this->addColumn('from', array(
          'header'    => Mage::helper('sendsms')->__('From'),
          'align'     =>'left',
          'index'     => 'from',
      ));
	  
	  $this->addColumn('to', array(
          'header'    => Mage::helper('sendsms')->__('To'),
          'align'     =>'left',
          'index'     => 'to',
      ));
	  
	  $this->addColumn('sms_message', array(
          'header'    => Mage::helper('sendsms')->__('SMS Message'),
          'align'     =>'left',
          'index'     => 'sms_message',
      ));
	  
	  $this->addColumn('status', array(
          'header'    => Mage::helper('sendsms')->__('Status'),
          'align'     =>'left',
          'index'     => 'status',
      ));
	  
	  $this->addColumn('status_message', array(
          'header'    => Mage::helper('sendsms')->__('Status Message'),
          'align'     =>'left',
          'index'     => 'status_message',
      ));
	  
	  $this->addColumn('created_time', array(
          'header'    => Mage::helper('sendsms')->__('Created Time'),
          'align'     =>'left',
          'index'     => 'created_time',
		  'type'	  => 'datetime',
      ));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('sendsms_id');
        $this->getMassactionBlock()->setFormFieldName('sendsms');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('sendsms')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('sendsms')->__('Are you sure?')
        ));

        return $this;
    }
}