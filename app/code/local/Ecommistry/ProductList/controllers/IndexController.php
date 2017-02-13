<?php
class Ecommistry_ProductList_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	if(!Mage::getSingleton('customer/session')->isLoggedIn()){
	        $this->_redirect('*/*/');
	    }else{
	        $collection = Mage::getModel('catalog/product')->getCollection();
			$collection->addAttributeToSelect('sku');  
			$collection->addAttributeToSelect('handle_display');
			
			$collection->addFieldToFilter(array(
			    array('name'=>'handle_display','eq'=>'1'),       
			));

			foreach ($collection as $product) {			    
			    var_dump($product->getData());
			}
	    }
		
    } 
}