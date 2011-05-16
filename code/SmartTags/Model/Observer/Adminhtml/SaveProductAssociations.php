<?php
/**
 * @category    Magneto
 * @package     Magneto_SmartTags
 * @license     
 * @author      
 */

class Magneto_SmartTags_Model_Observer_Adminhtml_SaveProductAssociations
{
	/**
	 * Save the product/tag associations
	 */
	public function saveAssociations(Varien_Event_Observer $observer)
	{
		try {
			if ($this->_getProduct()) {
				$this->_deleteCurrentAssociations();
				$this->_addNewAssociations();
			}
		}
		catch (Exception $e) {
			Mage::logException($e);
		}
	}

	/**
	 * Deletes the associations for the current product and tags
	 * 
	 * @return bool
	 */
	protected function _deleteCurrentAssociations()
	{
		$model = Mage::getModel('tag/tag_relation')
	            ->removeProductRelations($this->_getProduct()->getEntityId());
	}

	/**
	 * Adds the new associations for the current product and tags
	 * 
	 * @return bool
	 */
	protected function _addNewAssociations()
	{
		$assocIds = $this->_getIds();
		
		foreach($assocIds as $tag_id) {
			$model = Mage::getModel('tag/tag_relation')
	            ->setProductId($this->_getProduct()->getEntityId())
	            ->setTagId($tag_id);
				
			$model->save();	
		}
	}
	
	/**
	 * Loads the current Product model
	 *
	 * @return Mage_Catalog_Model_Product
	 */
	protected function _getProduct()
	{	
		return ($product = Mage::registry('product')) ? $product : false;
	}
	
	/**
	 * Loads either tag ID's
	 *
	 * @return array
	 */
	protected function _getIds()
	{
		$assocIds = array();

		$links = Mage::app()->getRequest()->getPost('links');
			if (isset($links['tags'])) {
				$assocIds = Mage::helper('adminhtml/js')->decodeGridSerializedInput($links['tags']);
				$assocIds = array_keys($assocIds);
			}
		
		return $assocIds;
	}
	
	/**
	 * Retrieve the resource class
	 *
	 */
	protected function _getResource()
	{
		return Mage::getSingleton('core/resource');
	}
}
