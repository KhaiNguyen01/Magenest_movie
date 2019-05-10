<?php
namespace Khai\ManufacturerEntity\Model;
class Entity extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'khai_manufaturerentity_entity';

    protected $_cacheTag = 'khai_manufaturerentity_entity';

    protected $_eventPrefix = 'khai_manufaturerentity_entity';

    protected function _construct()
    {
        $this->_init('Khai\ManufacturerEntity\Model\ResourceModel\Entity');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}