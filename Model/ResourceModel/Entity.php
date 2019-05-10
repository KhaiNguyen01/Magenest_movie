<?php
namespace Khai\ManufacturerEntity\Model\ResourceModel;


class Entity extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('manufacturer_entity', 'id');
    }

}