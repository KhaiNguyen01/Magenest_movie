<?php
namespace Khai\Parttime\Model\ResourceModel;


class Member extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('magenest_part_time', 'id');
    }

}