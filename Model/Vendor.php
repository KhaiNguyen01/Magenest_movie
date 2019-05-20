<?php
namespace Magenest\Khai\Model;
class Vendor extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'magenest_khai_vendor';

    protected $_cacheTag = 'magenest_khai_vendor';

    protected $_eventPrefix = 'magenest_khai_vendor';

    protected function _construct()
    {
        $this->_init('Magenest\Khai\Model\ResourceModel\Vendor');
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