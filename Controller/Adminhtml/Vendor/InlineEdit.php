<?php

namespace Magenest\Khai\Controller\Adminhtml\Vendor;

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
                    $model = $this->_objectManager->create('Magenest\Khai\Model\Vendor');
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
     * @param \Magenest\Khai\Model\Vendor $member
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithBannerId(\Magenest\Khai\Model\Vendor $member, $errorText)
    {
        return '[ID: ' . $member->getId() . '] ' . $errorText;
    }
}