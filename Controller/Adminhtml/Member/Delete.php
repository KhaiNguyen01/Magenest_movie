<?php

namespace Khai\Parttime\Controller\Adminhtml\Member;

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
                $model = $this->_objectManager->create('Khai\Parttime\Model\Member');
                $model->load($manuId);
                $model->delete();
                $this->messageManager->addSuccess(__('The Member has been deleted successfully.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to the question grid
                return $resultRedirect->setPath('*/*/index');
            }
        }
        // display error message
        $this->messageManager->addError(__('Member doesn\'t exist any longer.'));
        // go to the question grid
        return $resultRedirect->setPath('*/*/index');
    }
}