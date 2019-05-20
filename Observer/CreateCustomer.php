<?php
namespace Magenest\Khai\Observer;

use Magento\Customer\Model\CustomerFactory as Customer;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magenest\Khai\Model\VendorFactory;

class CreateCustomer implements \Magento\Framework\Event\ObserverInterface
{
    protected $_customerRepositoryInterface;
    protected $_vendor;

    public function __construct(VendorFactory $vendor, CustomerRepositoryInterface $customerRepositoryInterface)
    {
        $this->_vendor = $vendor;
        $this->_customerRepositoryInterface = $customerRepositoryInterface;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $_customer = $observer->getCustomer();
        if($_customer->getCustomAttribute('is_approved')->getValue()){
            $id = $_customer->getId();
            $firstname = $_customer->getFirstname();
            $lastname = $_customer->getLastname();
            $email = $_customer->getEmail();
            $model = $this->_vendor->create();
            $connection = $model->getResource()->getConnection();
            //$this->customerRepositoryInterface->getById($_customer->getId())->setCustomAttribute('is_approved',true);
            $insertData = [
                "customer_id" => $id,
                "first_name" => $firstname,
                'last_name' => $lastname,
                "email" => $email,
            ];
            try {
                $connection->beginTransaction();
                $connection->insertMultiple('magenest_test_vendor_khai', $insertData);
                $connection->commit();
            } catch (Exception $e) {
                $connection->rollBack();
            }
        }
    }
}