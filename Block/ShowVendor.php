<?php

namespace Magenest\Khai\Block;

use Magento\Framework\View\Element\Template\Context;
use Magenest\Khai\Model\VendorFactory as Vendor;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Customer\Model\Session;
/**
 * Test List block
 */
class ShowVendor extends \Magento\Framework\View\Element\Template
{
    protected $vendor;

    protected $customerSession;

    public function __construct( Context $context, Vendor $vendor, StoreManagerInterface $storeManager, Session $customerSession)
    {
        $this->vendor = $vendor;
        $this->_storeManager = $storeManager;
        $this->customerSession = $customerSession;
        parent::__construct($context);
    }

    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Vendor Info'));

        return parent::_prepareLayout();
    }

    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }

    public function  getVendor()
    {
        $vendor = $this->vendor->create()->getCollection();
        return $vendor;
    }

    public function getCustomerInfo()
    {
        $info = $this->customerSession->getCustomer();
        return $info;
    }

}