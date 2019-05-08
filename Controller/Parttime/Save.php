<?php

namespace Khai\Parttime\Controller\Parttime;


use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\TestFramework\Inspection\Exception;
use Khai\Parttime\Model\MemberFactory;
class Save extends \Magento\Framework\App\Action\Action
{
    /**
     * @var MemberFactory
     */
    protected $member;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Context $context,
        MemberFactory $member

    ) {
        $this->member = $member;
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
            $model = $this->member->create()->load($id);
            $model->setData($data)->save();
            $this->_redirect('*/*/');
        }

    }

}