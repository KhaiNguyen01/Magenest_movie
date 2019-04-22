<?php
namespace Magenest\Movie\Controller\Adminhtml\Test;
use Magenest\Movie\Model\MagenestMovie as Movie;
use Magento\Backend\App\Action;

class Delete extends \Magento\Backend\App\Action
{
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        if (!($movie = $this->_objectManager->create(Movie::class)->load($id))) {
            $this->messageManager->addError(__('Unable to proceed. Please, try again.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }
        try{
            $movie->delete();
            $this->messageManager->addSuccess(__('Your movie has been deleted !'));
        } catch (Exception $e) {
            $this->messageManager->addError(__('Error while trying to delete movie: '));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index', array('_current' => true));
    }
}