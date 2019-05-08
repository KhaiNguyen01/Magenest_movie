<?php

namespace Khai\Parttime\Controller\Adminhtml\Member;

//use Khai\Test\Model\ManufacturerFactory as Manufacturer;
//use Magento\Framework\App\Action\Context;
//use Magento\Framework\Controller\ResultFactory;
//
//
//class Save extends \Magento\Framework\App\Action\Action
//{
//    protected $_manufacturer;
//
//    public function __construct(Context $context, Manufacturer $manufacturer)
//    {
//        $this->_manufacturer = $manufacturer;
//        parent::__construct($context);
//    }
//
//    /**
//     * @return void
//     */
//    public function execute()
//    {
////        $data = $this->getRequest()->getParam('movieui');
//        $data = $this->getRequest()->getPostValue();
//        $manufacturerModel = $this->_manufacturer->create();
//        $manufacturerModel->setData($data)->save();
//
//        $this->messageManager->addSuccessMessage('Add done !');
//
//
//        $this->_redirect('test/manufacturer');
//
//    }
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\TestFramework\Inspection\Exception;
use Khai\Parttime\Model\Member;
class Save extends \Magento\Backend\App\Action
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor

    ) {
        $this->dataPersistor = $dataPersistor;
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
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('id');
            if (empty($data['id'])) {
                $data['id'] = null;
            }
            /** @var \Khai\Parttime\Model\Member $model */
            $model = $this->_objectManager->create('Khai\Parttime\Model\Member')->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addError(__('This member no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
            $model->setData($data);
            try {
                $model->save();
                $this->messageManager->addSuccess(__('You saved the member.'));
                $this->dataPersistor->clear('member');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the member.'));
            }
            $this->dataPersistor->set('member', $data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

}