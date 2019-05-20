<?php

namespace Magenest\Khai\Controller\Customer;


use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\TestFramework\Inspection\Exception;
use Magenest\Khai\Model\VendorFactory;
class Save extends \Magento\Framework\App\Action\Action
{
    /**
     * @var MemberFactory
     */
    protected $vendor;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Context $context,
        VendorFactory $vendor

    ) {
        $this->vendor = $vendor;
        parent::__construct($context);
    }
    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if($data){
            $id = $this->getRequest()->getParam('id');
            $model = $this->vendor->create()->load($id);
            $model->setData($data)->save();
            $this->_redirect('*/*/');
        }

    }

}