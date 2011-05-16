<?php

class Magneto_SmartTags_Block_Catalog_Product_Edit_Tabs extends Mage_Adminhtml_Block_Catalog_Product_Edit_Tabs 
{
	protected function _prepareLayout()
	{
		$return = parent::_prepareLayout();
		
		$product = $this->getProduct();

        if (!($setId = $product->getAttributeSetId())) {
            $setId = $this->getRequest()->getParam('set', null);
        }

        if ($setId) {
            if( $this->getRequest()->getParam('id', false) ) {
                if (Mage::getSingleton('admin/session')->isAllowed('admin/catalog/tag')){
                    $this->addTab('tags', array(
                     'label'    => Mage::helper('catalog')->__('Product Tags'),
                     'url'      => $this->getUrl('*/*/tag', array('_current' => true)),
                     'class'    => 'ajax',
                    ));
				}
			}
		}
		
		// unset($this->_tabs['tags']);
		
		return $return;
	}
}
