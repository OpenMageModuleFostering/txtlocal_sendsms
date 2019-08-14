<?php
class txtlocal_sendsms_Block_Buttons extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $this->setElement($element);
		$url = 'http://control.txtlocal.co.uk';

        $html = $this->getLayout()->createBlock('adminhtml/widget_button')
                    ->setType('button')
                    ->setClass('button')
                    ->setLabel(Mage::helper('sendsms')->__('Get an Account'))
                    ->setOnClick("window.open('$url','window1','width=870, height=705, scrollbars=1, resizable=1'); return false;")
                    ->toHtml();

        return $html;
    }
}
?>