<?php
namespace Khai\Parttime\Observer;

use Khai\Parttime\Model\MemberFactory;

class CreateMember implements \Magento\Framework\Event\ObserverInterface
{
    protected $_member;

    public function __construct(\Khai\Parttime\Model\MemberFactory $member)
    {
        $this->_member = $member;

    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $_customer = $observer->getCustomer();
        $name = $_customer->getFirstname()."". $_customer->getLastname();
        $address = $_customer->getEmail();
        $model = $this->_member->create();
        $connection = $model->getResource()->getConnection();
        $insertData = [
                "name" => $name,
                "address" => $address,
                "phone" => '111111111',
            ];
        try {
            $connection->beginTransaction();
            $connection->insertMultiple('magenest_part_time', $insertData);
            $connection->commit();
        } catch (Exception $e) {
            $connection->rollBack();
        }
    }
}