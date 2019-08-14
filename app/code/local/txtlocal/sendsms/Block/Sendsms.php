<?php
class txtlocal_sendsms_Block_Sendsms extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getSendsms()     
     { 
        if (!$this->hasData('sendsms')) {
            $this->setData('sendsms', Mage::registry('sendsms'));
        }
        return $this->getData('sendsms');
        
    }
}