<?php
namespace Khai\Parttime\Model;
class Member extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'khai_parttime_member';

    protected $_cacheTag = 'khai_parttime_member';

    protected $_eventPrefix = 'khai_parttime_member';

    protected function _construct()
    {
        $this->_init('Khai\Parttime\Model\ResourceModel\Member');
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