<?php


class Magneto_SmartTags_Model_Tag_Relation extends Mage_Tag_Model_Tag_Relation 
{
	public function removeProductRelations( $product_id )
	{
		$this->_getResource()->removeProductRelations($product_id);
	}
}
