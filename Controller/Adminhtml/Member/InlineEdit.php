<?php

namespace Khai\Parttime\Controller\Adminhtml\Member;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

class InlineEdit extends \Magento\Backend\App\Action
{
    /** @var JsonFactory */
    protected $jsonFactory;

    /**
     * @param Context $context
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory
    )
    {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];
        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $id) {
                    /** @var \Khai\Test\Model\Manufacturer $model */
                    $model = $this->_objectManager->create('Khai\Parttime\Model\Member');
                    $model->load($id);
                    try {
                        $model->setData(array_merge($model->getData(), $postItems[$id]));
                        $model->save();
                    } catch (\Exception $e) {
                        $messages[] = $this->getErrorWithBannerId(
                            $model,
                            __($e->getMessage())
                        );
                        $error = true;
                    }
                }
            }
        }
        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Add banner name to error message
     *
     * @param \Khai\Test\Model\Manufacturer $manufacturer
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithBannerId(\Khai\Test\Model\Member $member, $errorText)
    {
        return '[ID: ' . $member->getId() . '] ' . $errorText;
    }
}