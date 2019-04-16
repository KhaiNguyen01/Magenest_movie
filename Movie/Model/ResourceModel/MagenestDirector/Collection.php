<?php
namespace Magenest\Movie\Model\ResourceModel\MagenestDirector;

/**
 * Subscription Collection
 */
class Collection extends
    \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Initialize resource collection
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('Magenest\Movie\Model\MagenestDirector',
            'Magenest\Movie\Model\ResourceModel\MagenestDirector');
    }
}