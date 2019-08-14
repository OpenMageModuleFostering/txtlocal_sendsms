<?php
class txtlocal_sendsms_Block_System_Config_Buycredits
    extends Mage_Adminhtml_Block_Abstract
    implements Varien_Data_Form_Element_Renderer_Interface
{

    /**
     * Render fieldset html
     *
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $html = '<div style="margin-bottom:10px;padding:10px 5px 5px;">
					<iframe src="https://control.txtlocal.co.uk/order/" width="100%" height="705px"></iframe>
                </div>';
        //display iFrame of buy credits page!

        return $html;
    }
}