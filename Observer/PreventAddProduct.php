<?php

namespace Khai\Parttime\Observer;

use Magento\Framework\Event\ObserverInterface;
use Khai\Parttime\Helper\Data;

class PreventAddProduct implements ObserverInterface
{
    protected $helperData;

    public function __construct(
       Data $helperData
    )
    {
        $this->helperData = $helperData;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $_product = $observer->getProduct();
        $product_name = $_product->getName();
        $name = $this->helperData->getGeneralConfig('product_name');
        if(stristr($product_name,$name)){
            throw new \Exception('We can\'t add this product to cart right now!');
        }
    }
}