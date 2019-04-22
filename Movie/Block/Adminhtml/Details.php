<?php

namespace Magenest\Movie\Block\Adminhtml;

use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\ObjectManagerInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as Product;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory as Customer;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory as Order;
use Magento\Sales\Model\ResourceModel\Order\Invoice\CollectionFactory as Invoice;
use Magento\Sales\Model\ResourceModel\Order\Creditmemo\CollectionFactory as Creditmemo;
use Magento\Framework\Module\FullModuleList;

class Details extends \Magento\Framework\View\Element\Template
{
    protected $_customerFactory;
    protected $_productFactory;
    protected $_orderFactory;
    protected $_invoiceRepositoryFactory;
    protected $_creditmemoFactory;
    protected $fullModuleList;

    public function __construct(
        Context $context,
        Customer $customerFactory,
        Product $productFactory,
        Order $orderFactory,
        Invoice $invoiceRepositoryFactory,
        Creditmemo $creditmemoFactory,
        ObjectManagerInterface $objectManager,
        FullModuleList $fullModuleList,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->_customerFactory = $customerFactory;
        $this->_productFactory = $productFactory;
        $this->_orderFactory = $orderFactory;
        $this->_invoiceRepositoryFactory = $invoiceRepositoryFactory;
        $this->_creditmemoFactory = $creditmemoFactory;
        $this->_objectManager = $objectManager;
        $this->fullModuleList = $fullModuleList;
    }

    public function getCustomerCollection()
    {
        return $this->_customerFactory->create();
    }

    public function getProductCollection()
    {
        return $this->_productFactory->create();
    }

    public function getOrderCollection()
    {
        return $this->_orderFactory->create();
    }

    public function getInvoiceCollection()
    {
        return $this->_invoiceRepositoryFactory->create();
    }

    public function getCreditmemoCollection()
    {
        return $this->_creditmemoFactory->create();
    }

    public function modulesList()
    {
        $allModules = $this->fullModuleList->getAll();
        $numbersOfModule = count($allModules);
        return $numbersOfModule;
    }

    public function otherModules()
    {
        $countOther = 0;
        $allModules = $this->fullModuleList->getNames();
        foreach ($allModules as $allModule) {
            if (stristr($allModule, "Magento", False)) {
                $countOther++;
            }
        }
        return $countOther;
    }
}