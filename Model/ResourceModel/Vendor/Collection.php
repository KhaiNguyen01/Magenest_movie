<?php
namespace Magenest\Khai\Model\ResourceModel\Vendor;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'magenest_khai_vendor_collection';
    protected $_eventObject = 'vendor_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magenest\Khai\Model\Vendor', 'Magenest\Khai\Model\ResourceModel\Vendor');
    }

}