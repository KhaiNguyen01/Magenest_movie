<?php
namespace Khai\ManufacturerEntity\Model\ResourceModel\Entity;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'khai_manufacturerentity_entity_collection';
    protected $_eventObject = 'entity_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Khai\ManufacturerEntity\Model\Entity', 'Khai\ManufacturerEntity\Model\ResourceModel\Entity');
    }

}