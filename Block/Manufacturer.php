<?php

namespace Khai\ManufacturerEntity\Block;

use Magento\Framework\View\Element\Template\Context;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as Product;
use Khai\ManufacturerEntity\Model\ResourceModel\Entity\CollectionFactory as Entity;


/**
 * Test List block
 */
class Manufacturer extends \Magento\Framework\View\Element\Template
{

    protected $manufacturer;
    protected $product;

    public function __construct(
        Context $context,
        Product $productCollectionFactory,
        Entity $manufacturer,
        array $data = [])
    {

        $this->manufacturer = $manufacturer;
        $this->product = $productCollectionFactory;

        parent::__construct($context, $data);
    }


    public function getEntity()
    {
        $collection = $this->manufacturer->create();
        return $collection;
    }

    public function getProduct()
    {
        //get current product in product view page
        $objectManager =  \Magento\Framework\App\ObjectManager::getInstance();
        $registry = $objectManager->get('\Magento\Framework\Registry');
        $currentProduct = $registry->registry('product');
        return $currentProduct;
    }

}