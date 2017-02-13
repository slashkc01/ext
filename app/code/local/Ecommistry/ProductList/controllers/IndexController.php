<?php
class Ecommistry_ProductList_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	if(!Mage::getSingleton('customer/session')->isLoggedIn()){
	        $this->_redirect('/');
	    }else{
	        $collection = Mage::getModel('catalog/product')->getCollection();
			$collection->addAttributeToSelect('sku');
			
			$collection->addFieldToFilter( 'handle_display', array('eq'=>1));

			$productListCollection = array();
			foreach ($collection as $product) {			    
			    $productListCollection['products'][] = $product->getData('sku');
			}

			$productListCollection['slidermode'] = $this->getRequest()->getParam('mode');	
					
			$block = $this->getLayout()->createBlock('core/template');
	        $block->setTemplate('productlist/productlistview.phtml');
	        $block->setProductlist($productListCollection);	        
	        echo $block->toHtml();
	    }
		
    } 
}