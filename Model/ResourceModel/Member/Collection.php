<?php
namespace Khai\Parttime\Model\ResourceModel\Member;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'khai_parttime_member_collection';
    protected $_eventObject = 'member_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Khai\Parttime\Model\Member', 'Khai\Parttime\Model\ResourceModel\Member');
    }

}