<?php

namespace Magenest\Khai\Controller\Adminhtml\Vendor;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class NewAction extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}