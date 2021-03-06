<?php
$attr = Mage::getModel('catalog/resource_eav_attribute')->loadByCode('catalog_product','handle_display');
if (null!==$attr->getId()) {     
    //already exist    
}else{
    //do not exist    
    $installer = $this;
    $installer->startSetup();

    $installer->addAttribute('catalog_product', 'handle_display', array(
        'group'             => 'Handle Display',
        'label'             => 'Handle Display',
        'input' 			=> 'boolean',
    	'type' 				=> 'int',
        'backend'           => '',
        'frontend'          => '',
        'visible'           => true,
        'required'          => false,
        'user_defined'      => true,
        'searchable'        => false,
        'filterable'        => true,
        'comparable'        => false,
        'visible_on_front'  => true,
        'visible_in_advanced_search' => false,
        'unique'            => false,
        'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    ));

    $installer->endSetup();

}