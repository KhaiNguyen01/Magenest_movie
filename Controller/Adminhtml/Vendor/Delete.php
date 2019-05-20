<?php

namespace Magenest\Khai\Controller\Adminhtml\Vendor;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * Delete Manufacturer
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        // check if we know what should be deleted
        $manuId = (int)$this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($manuId && (int) $manuId > 0) {
            try {
                $model = $this->_objectManager->create('Magenest\Khai\Model\Vendor');
                $model->load($manuId);
                $model->delete();
                $this->messageManager->addSuccess(__('The vendor has been deleted successfully.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to the question grid
                return $resultRedirect->setPath('*/*/index');
            }
        }
        // display error message
        $this->messageManager->addError(__('Vendor doesn\'t exist any longer.'));
        // go to the question grid
        return $resultRedirect->setPath('*/*/index');
    }
}