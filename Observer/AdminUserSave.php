<?php

namespace Magenest\Khai\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use Magento\User\Model\User;
use Magenest\Khai\Model\VendorFactory;

class AdminUserSave implements ObserverInterface
{
    protected $vendor;
    /**
     * Backend configuration interface
     *
     * @var \Magento\User\Model\Backend\Config\ObserverConfig
     */
    protected $observerConfig;

    /**
     * Admin user resource model
     *
     * @var \Magento\User\Model\ResourceModel\User
     */
    protected $userResource;
    protected $messageManager;

    public function __construct(\Magento\User\Model\Backend\Config\ObserverConfig $observerConfig,
                                \Magento\User\Model\ResourceModel\User $userResource,
                                VendorFactory $vendor,
                                \Magento\Framework\Message\ManagerInterface $messageManager)
    {
        $this->observerConfig = $observerConfig;
        $this->userResource = $userResource;
        $this->vendor = $vendor;
        $this->messageManager = $messageManager;
    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $user = $observer->getEvent()->getObject();
        $user_email = $user->getEmail();
        try {
            $model = $this->vendor->create();
            $model->load($user_email,'email');
            $model->delete();
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }
    }
}