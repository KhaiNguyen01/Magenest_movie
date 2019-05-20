<?php

namespace Magenest\Khai\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Model\ResourceModel\Order\Collection;
use Magenest\Khai\Model\VendorFactory as Vendor;
use Magento\Catalog\Model\ProductFactory;
use Magento\User\Model\Backend\Config\ObserverConfig;

class OrderData implements ObserverInterface
{
    protected $vendor;
    protected $_collection;
    protected $product;

    public function __construct(Vendor $vendor, Collection $collection, ProductFactory $product)
    {
        $this->vendor = $vendor;
        $this->_collection = $collection;
        $this->product = $product;
    }

    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $items = $order->getAllVisibleItems();
        foreach ($items as $item){
            $product_id = $item->getProductId();
            $price = $item->getPrice();
            $qty = $item->getQtyOrdered();
            $total = $price*$qty;
            if($order->getStatus() == 'processing'){
                $product = $this->product->create()->load($product_id);
                $att = $product->getCustomAttribute('khai_product_vendor')->getValue();
                $vendor = $this->vendor->create()->load($att);
                $total_sales = $vendor->getTotalSales()+$total;
                $vendor->setTotalSales($total_sales);
                $vendor->save();
            }
        }
    }
}