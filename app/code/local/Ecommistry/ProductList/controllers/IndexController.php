<?php
class Ecommistry_ProductList_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	if(!Mage::getSingleton('customer/session')->isLoggedIn()){
	        $this->_redirectUrl('/customer/account/login/');
	    }else{
	    	$attr = Mage::getModel('catalog/resource_eav_attribute')->loadByCode('catalog_product','handle_display');
			if (null!==$attr->getId()) {
		        $collection = Mage::getModel('catalog/product')->getCollection();
				$collection->addAttributeToSelect('sku');			
				$collection->addFieldToFilter( 'handle_display', array('eq'=>1));
				$collection->getSelect()->limit(10);

				$productListCollection = array();
				foreach ($collection as $product) {			    
				    $productListCollection['products'][] = $product->getData('sku');
				}

				$productListCollection['slidermode'] = $this->getRequest()->getParam('mode');	
				/*		
				$block = $this->getLayout()->createBlock('core/template');
		        $block->setTemplate('productlist/productlistview.phtml');
		        $block->setProductlist($productListCollection);	        
		        echo $block->toHtml();
				*/
				Mage::register('productlist', $productListCollection);
				$this->loadLayout();
		        $this->renderLayout();
	    	}else{
	    		/*	if productlist_setup was present in core_resource and handle_display was not found in eav_attribute
					we are deleting the productlist_setup in core_resource to reinstall the module
	    		*/
	    		$sql = "DELETE FROM core_resource WHERE code = 'productlist_setup'";			 
			    $connection = Mage::getSingleton('core/resource')->getConnection('core_write');			 
			    try {
			        $connection->query($sql);
			        //reload page to reinstall module
			        $this->_redirectUrl('/productlist/index/');
			    } catch (Exception $e) {
			        echo $e->getMessage();
			    }
	    	}
	    }
		
    } 
}