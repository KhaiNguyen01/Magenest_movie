<?php

namespace Magenest\Khai\Controller\Customer;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use Magenest\Khai\Model\VendorFactory;

class Result extends \Magento\Framework\App\Action\Action
{

    /**
     * @var Magento\Framework\View\Result\PageFactory
     *
     */

    protected $resultPageFactory;

    protected $resultJsonFactory;

    protected $vendor;

    /**
     * @param Context     $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory,
        VendorFactory $vendor
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->vendor = $vendor;
        return parent::__construct($context);
    }


    public function execute()
    {
        $email = $this->getRequest()->getParam('email');
        $result = $this->resultJsonFactory->create();
        $data = $this->vendor->create()->load($email,'email');
        $vendorId = $data->getId();
        if (!$vendorId) {
            return $result->setData(1);
        } else {
            return $result->setData(0);
        }

    }
}