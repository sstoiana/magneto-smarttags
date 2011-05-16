<?php

class Magneto_SmartTags_Model_Mysql4_Tag_Relation extends Mage_Tag_Model_Mysql4_Tag_Relation
{
	public function removeProductRelations($product_id) 
	{
		$this->_getWriteAdapter()->delete($this->getMainTable(), array(
			$this->_getWriteAdapter()->quoteInto('product_id = ?', $product_id),
			'customer_id IS NULL'
		));
	} 
}
