<?php

require_once 'Mage/Adminhtml/controllers/Catalog/ProductController.php';
class Magneto_SmartTags_Catalog_ProductController extends Mage_Adminhtml_Catalog_ProductController
{
       
    /**
     * Get related products grid and serializer block
     */
    public function tagAction()
    {
        $this->_initProduct();
        $this->loadLayout();
        $this->getLayout()->getBlock('admin.product.tags')
            ->setProductId($this->getRequest()->getParam('id'))
                               ->setProductsTags($this->getRequest()->getPost('products_tags', null));;
        $this->renderLayout();
    }
	
	 public function tagGridAction()
     {
       $this->_initProduct();
         $this->loadLayout();
         $this->getLayout()->getBlock('admin.product.tags')
                ->setProductId($this->getRequest()->getParam('id'))
                               ->setProductsTags($this->getRequest()->getPost('products_tags', null));;
         $this->renderLayout();
     }
	

}
